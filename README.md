raspberry-simplicity-api
========================

Remote Raspberry aPI - Simplicity

This is intendtent to be the world most simple Raspberry PI Remote API. It's NOT secure! 'foldername' is the only thing that keep nobody away from controlling your PI.

API accept HTTP GET querys:

    http://raspberry:80/foldername/?t=task

I recommend using lighttpd:

    sudo apt-get install -y lighttpd php5-cli php5-cgi php5-mysql php5
    sudo lighty-enable-mod fastcgi && sudo lighty-enable-mod fastcgi-php && sudo service lighttpd force-reload

lighttpd running as an normal www-data user. there is only 1 simple PHP controller file to be placed in www/ folder:
    sudo mkdir /var/www/foldername/ && sudo cp /opt/raspberry-simplicity-api/www/public/index.php /var/www/foldername/

This taks the variable $_REQUEST['t'] and put the command into a processing queue: /opt/raspberry-simplicity-api/queue/lighttpd.queue

A PHP processiong script is running about every second and process this queue:

Add to crontab:
    @reboot /opt/raspberry-simplicity-api/loop.sh php /opt/raspberry-simplicity-api/lighttpd_process.php &> /dev/null

Start manually, at first run:
    ~/bin/loop.sh php ~/bin/lighttpd_process.php &> /dev/null &

In this process script you can add what you want to run by the pi user or sudo at spesific events:

    if($t == 'reboot') {
        exec('sudo reboot');
    }

Keep in mind: This is NOT secure, just quick and dirty!

Now tou can controll this PI by any computer in the universe:
    wget --spider -q http://raspberry/foldername/?t=reboot

We still need another proper API... Please help us ;)

- Rune Hetlelid
Norway
