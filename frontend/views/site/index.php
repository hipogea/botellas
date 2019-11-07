<?php
use dosamigos\chartjs\ChartJs;
if (Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-warning">
         
         <?= Yii::$app->session->getFlash('info') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
         
         <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
         
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>


<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">
                <i class="fa fa-gear"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Conf.</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">
                <i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Param</span>
              <span class="info-box-number">52</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green">
                <i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">RBAC</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua ">
                <i class="fa fa-desktop"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">App</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      
      
       <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              
            <div class="card">
              <div class="card-header">
                  <h4>Indice de morosidad</h4>
                
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
        'labels' => ["MAGIC", "PLAT", "ACA", "VIS", "FIC", "FIQ", "FII"],
        'datasets' => [
            [
                'label' => yii::t('sta.labels',"Del mes"),
                'backgroundColor' => "rgba(255,157,64,0.9)",
                'borderColor' => "rgba(60,117,9,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' =>  yii::t('sta.labels',"Anual"),
                'backgroundColor' => "rgba(232,18,171,1)",
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
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- Info Boxes Style 2 -->
            <h4>Los mayores deudores</h4>
            <div class="info-box mb-3 bg-yellow">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Magic 104</span>
                <span class="info-box-number">S/. 1,234</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-purple-active">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Platino-214</span>
                <span class="info-box-number">s/. 3.140</span>
              </div>
              <!-- /.info-box-content -->
            </div>
           
    
    
    
</div>
</div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

      <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              
          </div>  
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              
          </div>  
          
          
      </div>

<div class="box box-success">
    <br>
    <br>
     
               
          
      <br>
    <br><br>
    <br><br>
    <br><br>
    <br>

    </div>