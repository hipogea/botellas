<?php
/**
 *¡Es una clase que se hereda del componente
 * Mailer de yii\swiftmailer;
 * La ventaja es que lso parametros de configuracion 
 * los lee de una tabla en lugar del archivo config.php
 * Para esto se le asigna las propiedades al moemtno de 
 * inicializar
 */

namespace common\components;
use yii\swiftmailer\Mailer as Correo;
use common\helpers\h;
use yii;
class Mailer extends Correo
{
   use \common\traits\baseTrait;
    /**
     * @var string message default class name.
     */
    public $messageClass = 'yii\swiftmailer\Message';
    /**
     * @var bool whether to enable writing of the SwiftMailer internal logs using Yii log mechanism.
     * If enabled [[Logger]] plugin will be attached to the [[transport]] for this purpose.
     * @see Logger
     * @since 2.0.4
     */
    public $enableSwiftMailerLogging = false;

    /**
     * @var \Swift_Mailer Swift mailer instance.
     */
    private $_swiftMailer;
    /**
     * @var \Swift_Transport|array Swift transport instance or its array configuration.
     */
    private $_transport = [];

    const MAIL_PORT_DEFAULT='25';
    const MAIL_SERVER_DEFAULT='mail.neotegnia.com';
    const MAIL_USER_SERVER_DEFAULT='25';
    public function init(){
       // yii::$app->settings->set('section', 'key', 1258.5);
        $this->_transport=static::arrayConfig();
        
        return parent::init();
    }

    /**
     * @return array|\Swift_Mailer Swift mailer instance or array configuration.
     */
    public function getSwiftMailer()
    {
        if (!is_object($this->_swiftMailer)) {
            $this->_swiftMailer = $this->createSwiftMailer();
        }

        if (!$this->_transport->ping()) {
            $this->_transport->stop();
            $this->_transport->start();
        }

        return $this->_swiftMailer;
    }

    /**
     * @param array|\Swift_Transport $transport
     * @throws InvalidConfigException on invalid argument.
     */
    public function setTransport($transport)
    {
        if (!is_array($transport) && !is_object($transport)) {
            throw new InvalidConfigException('"' . get_class($this) . '::transport" should be either object or array, "' . gettype($transport) . '" given.');
        }
        $this->_transport = $transport;
        $this->_swiftMailer = null;
    }

    /**
     * @return array|\Swift_Transport
     */
    public function getTransport()
    {
        if (!is_object($this->_transport)) {
            $this->_transport = $this->createTransport($this->_transport);
        }

        return $this->_transport;
    }

    /**
     * @inheritdoc
     */
    protected function sendMessage($message)
    {
        /* @var $message Message */
        $address = $message->getTo();
        if (is_array($address)) {
            $address = implode(', ', array_keys($address));
        }
        Yii::info('Sending email "' . $message->getSubject() . '" to "' . $address . '"', __METHOD__);

        return $this->getSwiftMailer()->send($message->getSwiftMessage()) > 0;
    }

    /**
     * Creates Swift mailer instance.
     * @return \Swift_Mailer mailer instance.
     */
    protected function createSwiftMailer()
    {
        return new \Swift_Mailer($this->getTransport());
    }

    /**
     * Creates email transport instance by its array configuration.
     * @param array $config transport configuration.
     * @throws \yii\base\InvalidConfigException on invalid transport configuration.
     * @return \Swift_Transport transport instance.
     */
    protected function createTransport(array $config)
    {
        if (!isset($config['class'])) {
            $config['class'] = 'Swift_SendmailTransport';
        }
        if (isset($config['plugins'])) {
            $plugins = $config['plugins'];
            unset($config['plugins']);
        } else {
            $plugins = [];
        }

        if ($this->enableSwiftMailerLogging) {
            $plugins[] = [
                'class' => 'Swift_Plugins_LoggerPlugin',
                'constructArgs' => [
                    [
                        'class' => 'yii\swiftmailer\Logger'
                    ]
                ],
            ];
        }

        /* @var $transport \Swift_Transport */
        $transport = $this->createSwiftObject($config);
        if (!empty($plugins)) {
            foreach ($plugins as $plugin) {
                if (is_array($plugin) && isset($plugin['class'])) {
                    $plugin = $this->createSwiftObject($plugin);
                }
                $transport->registerPlugin($plugin);
            }
        }

        return $transport;
    }

    /**
     * Creates Swift library object, from given array configuration.
     * @param array $config object configuration
     * @return Object created object
     * @throws \yii\base\InvalidConfigException on invalid configuration.
     */
    protected function createSwiftObject(array $config)
    {
        if (isset($config['class'])) {
            $className = $config['class'];
            unset($config['class']);
        } else {
            throw new InvalidConfigException('Object configuration must be an array containing a "class" element.');
        }

        if (isset($config['constructArgs'])) {
            $args = [];
            foreach ($config['constructArgs'] as $arg) {
                if (is_array($arg) && isset($arg['class'])) {
                    $args[] = $this->createSwiftObject($arg);
                } else {
                    $args[] = $arg;
                }
            }
            unset($config['constructArgs']);
            $object = Yii::createObject($className, $args);
        } else {
            $object = Yii::createObject($className);
        }

        if (!empty($config)) {
            $reflection = new \ReflectionObject($object);
            foreach ($config as $name => $value) {
                if ($reflection->hasProperty($name) && $reflection->getProperty($name)->isPublic()) {
                    $object->$name = $value;
                } else {
                    $setter = 'set' . $name;
                    if ($reflection->hasMethod($setter) || $reflection->hasMethod('__call')) {
                        $object->$setter($value);
                    } else {
                        throw new InvalidConfigException('Setting unknown property: ' . $className . '::' . $name);
                    }
                }
            }
        }

        return $object;
    }
    
    /*
     * Lee los parametros de la tabla settings 
     * si no los encuentra los lee del archivo 
     * common/config/params-local  y los registra
     * en la tabla settings (Mediante la funcion 
     * getIfNotPutSetting())
     */
    private static function arrayConfig(){
        RETURN [
            'class' => 'Swift_SmtpTransport',
              'host' => h::getIfNotPutSetting(
                      'mail','servermail',
                      Yii::$app->params['servermail']
                      ),
               'username' => h::getIfNotPutSetting(
                       'mail','userservermail',
                       Yii::$app->params['userservermail']),
               'password' => h::getIfNotPutSetting(
                       'mail','passworduserservermail',
                       Yii::$app->params['passworduserservermail']),
               'port' =>h::getIfNotPutSetting(
                       'mail','portservermail',
                       Yii::$app->params['portservermail']),
                  'encryption' => 'tls',
              /*Esta line ase agergo apra que funcione en localhost */
                  'streamOptions'=>['ssl' =>['allow_self_signed' => true,'verify_peer_name' => false, 'verify_peer' => false]],
        ];
    }
}
