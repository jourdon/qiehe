@servers(['web' => 'vagrant@192.168.10.10'])

@task('deploy')
    cd /path/to/site
    git pull origin master
@endtask
