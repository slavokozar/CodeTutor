<?php $__env->startSection('wrapper'); ?>
    <section id="landing" class="propagation  text-center">
        <div class="container">
            <h1>Buď cool... programuj!</h1>
            <?php if(Auth::check()): ?>
                <a href="<?php echo e(action('Assignments\AssignmentController@index')); ?>"
                   class="btn btn-lg btn-danger">začni s nami</a>
            <?php else: ?>
                <a href="/login" class="btn btn-lg btn-danger">začni s nami</a>
            <?php endif; ?>

            <div id="banner-carousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <?php if($carousel->count() > 1): ?>
                    <ol class="carousel-indicators">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <li data-target="#banner-carousel" data-slide-to="<?php echo e($i); ?>"
                                <?php if($i == 0): ?>class="active"<?php endif; ?>></li>
                        <?php endfor; ?>
                    </ol>
                <?php endif; ?>

            <!-- Wrapper for slides -->
                <?php if($carousel->count() > 1): ?>
                    <div class="carousel-inner" role="listbox">
                        <?php for($i = 0; $i < 5; $i++): ?>
                            <?php $item = $carousel->get(0); ?>

                            <div class="item<?php echo e($i == 0 ? ' active' : ''); ?>">
                                <h3><?php echo e($item->name); ?></h3>

                                <p><?php echo e($item->description); ?></p>
                                <?php if($item instanceof \App\Models\Article): ?>
                                    <a href="<?php echo e(action('Articles\ArticleController@show',$item->code)); ?>">viac...</a>
                                <?php elseif($item instanceof \App\Models\Assignment): ?>
                                    <a href="<?php echo e(action('Assignments\AssignmentController@show',$item->code)); ?>">viac...</a>
                                <?php endif; ?>

                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="partners">
            <a href="">
                <img src="img/spse-logo.png"/>
            </a>
        </div>

    </section>

    <section id="how-cl-works" class="propagation dark">
        <div class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h2>Ako CodeLeague funguje</h2>

                    <p>kostrou CodeLeague je náš vlastný systém odovzdávania a testovania kódov</p>
                </div>

                <div class="col-md-40 col-md-offset-10 block">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-48">
                            autor vytvorí úlohy, vzorové vstupy a výstupy a zverejní zadanie
                        </div>
                    </div>
                </div>
                <div class="col-md-40 col-md-offset-10 block">
                    <div class="row">
                        <div class="col-md-48">
                            riešitelia vytvoria kód, uploadnu ho a sledujú ako ich riešenie spĺňa testy
                        </div>
                        <div class="col-md-12 text-center">
                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    

    
    
    
    

    
    
    
    


    
    <section id="schools" class="propagation dark">
        <div class="container">
            <div class="row">
                <div class="col-md-60 text-center">
                    <h2>CodeLeague pre Vašu školu</h2>
                    <h3>Náš systém - pomôcka pre Vašich učiteľov</h3>

                    <p>Systém primárne určený pre súťaž môže aj Vaša škola využiť pre modernizáciu výučby.</p>
                </div>
            </div>
            <div class="row">

                <div class="col-md-20 block">
                    <i class="ion-document-text" aria-hidden="true"></i>

                    vytvorte si zadanie, zadefinujte vstupy a výstupy a bodové hodnotenia

                </div>
                <div class="col-md-20 block">
                    <i class="ion-ios-people" aria-hidden="true"></i>

                    nechajte žiakov odovzdávať, hneď po odovzdaní uvidia ich úspešnosť


                </div>
                <div class="col-md-20 block">

                    <i class="fa fa-commenting-o fa-2x" aria-hidden="true"></i>

                    prezrite si odovzdané kódy, manuálne ich skontrolujte a okomentujte

                </div>
            </div>
            <div class="row">
                <div class="col-md-60 text-center">
                    <h4>pozdvihnite úroveň programovania na Vašej škole...</h4>
                </div>
                <div class="col-md-20 col-md-offset-20 text-center">
                    <a href="#contact" class="btn btn-lg btn-danger">kontaktujte nás</a>
                </div>


            </div>
        </div>
        </div>
    </section>
    
    
    
    
    
    
    
    

    
    
    
    

    
    
    
    

    
    


    
    
    

    
    
    
    
    
    
    
    

    
    

    
    

    
    
    
    
    

    
    
    
    
    
    

    
    
    

    

    
    
    
    
    
    

    

    
    
    
    
    
    

    

    
    
    
    
    
    

    

    
    
    
    
    
    

    

    
    

    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('wrapper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>