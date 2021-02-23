@servers(['web' => 'bitrix@bxvm.test'])

@task('deploy')
    cd ~/ext_www/survius.vm
    git pull origin AKuznetsov202010/master
    composer install
    npm run update
    phpunit
    php artisan migrate
@endtask
