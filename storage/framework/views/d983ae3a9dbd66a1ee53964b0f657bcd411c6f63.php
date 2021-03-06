<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(Auth::check() ? action('HomeController@index') : action('System\PresentationController@index')); ?>">
                <img src="<?php echo e(asset('img/codetutor-logo-white.png')); ?>" alt="CodeLeague">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if( Auth::check() ): ?>
                    <li>
                        <a href="<?php echo e(action('System\PresentationController@index')); ?>">o CodeTutor</a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="<?php echo e(action('Articles\ArticleController@index')); ?>">články</a>
                </li>
                <li>

                </li>
                <li>
                    <a href="<?php echo e(action('Assignments\AssignmentController@index')); ?>">zadania</a>
                </li>

                <?php if(Auth::check() && Auth::user()->isAdmin()): ?>
                    <li>
                        <a class="btn " href="<?php echo e(action('Users\UserController@index')); ?>">užívatelia</a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::check()): ?>
                    <li class="dropdown">
                        <a class="inverse" type="button" data-toggle="dropdown">
                            <?php echo e(Auth::user()->name); ?><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo e(action('Profile\ProfileController@edit')); ?>"><?php echo e(trans('profile.password.show')); ?></a></li>
                            <li><a href="<?php echo e(action('Profile\ProfileController@edit')); ?>"><?php echo e(trans('profile.password.link')); ?></a></li>

                            <li role="separator" class="divider"></li>

                            <li><a href="<?php echo e(action('Profile\ArticleController@index')); ?>"><?php echo e(trans('profile.articles.link')); ?></a></li>
                            <li><a href="<?php echo e(action('Profile\AssignmentController@index')); ?>"><?php echo e(trans('profile.assignments.link')); ?></a></li>
                            <li><a href="<?php echo e(action('Profile\FileController@index')); ?>"><?php echo e(trans('profile.files.link')); ?></a></li>
                            <li><a href="<?php echo e(action('Profile\LinkController@index')); ?>"><?php echo e(trans('profile.links.link')); ?></a></li>

                            <li role="separator" class="divider"></li>

                            <li><a href="<?php echo e(action('Auth\LoginController@logout')); ?>">Odhlásiť</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="inverse" href="/login">prihlásiť sa</a>
                    </li>
                <?php endif; ?>


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>