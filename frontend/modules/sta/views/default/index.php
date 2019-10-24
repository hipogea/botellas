<?php  
use dosamigos\chartjs\ChartJs;

?>
<div class="box box-success">
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        
        <div class="btn-group">
    <a href="<?=\yii\helpers\Url::toRoute('/sta/entregas')?>" class="btn btn-warning btn-lg ">
        <i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i> <?=yii::t('sta.labels','Entregas')?>
    </a>
    <a href="<?=\yii\helpers\Url::toRoute('/sta/test')?>" class="btn btn-success btn-lg ">
        <i class="glyphicon glyphicon-paste " aria-hidden="true"></i> <?=yii::t('sta.labels','Exámenes Piscotécnicos')?>
    </a>
            <a href="<?=\yii\helpers\Url::toRoute('/masters/trabajadores')?>" class="btn btn-primary btn-lg ">
        <i class="glyphicon glyphicon-user " aria-hidden="true"></i> <?=yii::t('sta.labels','Psicólogos')?>
    </a>
            
    <a href="<?=\yii\helpers\Url::toRoute('/sta/periodos')?>" class="btn btn-dark btn-lg ">
        <i class="glyphicon glyphicon-calendar " aria-hidden="true"></i> <?=yii::t('sta.labels','Periodos')?>
    </a>
</div>
        
        
       
        
        
     <H4><?=yii::t('sta.labels','Facultades'); ?></H4>
 
          <div class="row">
        <!---Income-->
         
       <div class="col-12 col-sm-6 col-md-3">  
           <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIA</h3></div> 
               <div class="panel-body">
          <a href="<?=\yii\helpers\Url::to("masters/centros")  ?>"><span class="info-box-icon bg-green-gradient"><i class="fa fa-envira"></i></span></a>
           </div> 
               </div> 
        </div> 
       <div class="col-12 col-sm-6 col-md-3"> 
           <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FAUA</h3></div> 
               <div class="panel-body">
            <a href="<?=\yii\helpers\Url::to("settings")  ?>"><span class="info-box-icon bg-aqua"><i class="fa fa-hospital-o"></i></span></a>
       </div> 
        </div> 
        </div>
        
        
       <div class="col-12 col-sm-6 col-md-3"> 
           <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIQ</h3></div> 
               <div class="panel-body">
               <a href="<?=\yii\helpers\Url::to("masters/parametros")  ?>"><span class="info-box-icon bg-orange-active"><i class="fa fa-flask"></i></span></a>
       </div> 
        </div> 
        </div>
        
        <div class="col-12 col-sm-6 col-md-3">    
            <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIC</h3></div> 
               <div class="panel-body">
               <a href="<?=\yii\helpers\Url::to("masters/documents")  ?>"><span class="info-box-icon bg-light-blue-gradient"><i class="fa fa-building"></i></span></a>
        </div> 
        </div> 
        </div>
        
        
            <div class="col-12 col-sm-6 col-md-3"> 
                <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FSCE</h3></div> 
               <div class="panel-body">
                 <a href="<?=\yii\helpers\Url::to("masters/documents")  ?>"><span class="info-box-icon bg-red-gradient"><i class="fa fa-usd"></i></span></a>
              </div> 
             </div>    
            </div> 
        
            <div class="col-12 col-sm-6 col-md-3">    
              <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIIS</h3></div> 
               <div class="panel-body">   
                  <a href="<?=\yii\helpers\Url::to("masters/documents")  ?>"><span class="info-box-icon bg-purple-gradient"><i class="fa fa-industry"></i></span></a>
            </div> 
            </div> 
           </div>
            <div class="col-12 col-sm-6 col-md-3"> 
                 <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIM</h3></div> 
               <div class="panel-body"> 
                  <a href="<?=\yii\helpers\Url::to("masters/documents")  ?>"><span class="info-box-icon bg-aqua"><i class="fa fa-wrench"></i></span></a>
        </div> 
               </div> 
           </div>
        
            <div class="col-12 col-sm-6 col-md-3"> 
                 <div class="panel panel-success">
               <div class="panel-heading"><h3 class="panel-title" >FIIE</h3></div> 
               <div class="panel-body"> 
                 <a href="<?=\yii\helpers\Url::to("masters/documents")  ?>"><span class="info-box-icon bg-blue-active"><i class="fa fa-microchip"></i></span></a>
        </div>  
                 </div> 
           </div>
            
    </div>

   
        <!-- /.row -->
 <h4 class="card-title"><?= yii::t('sta.labels','Inasistencias') ?></h4>

        <div class="row">
          <div class="col-md-8">
              
            <div class="card">
              <div class="card-header">
               
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            
                 
                   

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      
                    <?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 180,
        'width' => 400
    ],
    'data' => [
        'labels' => ["FIIE", "FAUA", "FIM", "FIA", "FIC", "FIQ", "FIIS"],
        'datasets' => [
            [
                'label' => yii::t('sta.labels',"Talleres"),
                'backgroundColor' => "rgba(115,218,22,0.9)",
                'borderColor' => "rgba(60,117,9,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' =>  yii::t('sta.labels',"Entrevistas"),
                'backgroundColor' => "rgba(255,209,40,1)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => [28, 48, 40, 19, 96, 27, 100]
            ]
        ]
    ]
]);
?>
                    </div>
                    <!-- /.chart-responsive -->
               
                  <!-- /.col -->
                  </div>
                  <!-- /.col -->
            </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-yellow">
              <span class="info-box-icon"><i class="fa fa-hourglass-end"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Horas Talleres</span>
                <span class="info-box-number">1,234</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-purple-active">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Alumnos</span>
                <span class="info-box-number">140</span>
              </div>
              <!-- /.info-box-content -->
            </div>
           
    
    
    
</div>
</div>
    </section>
</div>