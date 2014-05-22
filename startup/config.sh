#!/bin/sh -e

#make sure that shell script is run as root
if [[ $EUID -ne 0 ]]
then
	echo "You need to run this as root"
	exit 1
fi

if [[ $# -ne 1 ]]
then
	echo "You need to specify a client ID."
	exit 1
fi


#update pi
apt-get update --fix-missing

#install required libraries and browser
apt-get install unclutter chromium x11-xserver-utils ttf-mscorefonts-installer xwit sqlite3 libnss3 matchbox

#edit /etc/rc.local file to run the browser on startup
echo "

#!/bin/sh -e
#
# rc.local
#
# This script is executed at the end of each multiuser runlevel.
# Make sure that the script will "exit 0" on success or any other
# value on error.
#
# In order to enable or disable this script just change the execution
# bits.
#
# By default this script does nothing.

#blogs.wcode.org/2013/09/howto-boot-your-raspberry-pi-into-a-fullscreen-browser-kiosk/


# Wait for the TV-screen to be turned on...
while ! \$( tvservice --dumpedid /tmp/edid | fgrep -qv 'Nothing written!' ); do
	bHadToWaitForScreen=true;
	printf \"===> Screen is not connected, off or in an unknown mode, waiting for it to become available...\\n\"
	sleep 1;
done;

printf \"===> Screen is on, extracting preferred mode...\\n\"
_DEPTH=32;
eval \$( edidparser /tmp/edid | fgrep 'preferred mode' | tail -1 | sed -Ene 's/^.+(DMT|CEA) \\(([0-9]+)\\) ([0-9]+)x([0-9]+)[pi]? @.+/_GROUP=\\1;_MODE=\\2;_XRES=\\3;_YRES=\\4;/p' );

printf \"===> Resetting screen to preferred mode: %s-%d (%dx%dx%d)...\\n\" \$_GROUP \$_MODE \$_XRES \$_YRES \$_DEPTH
tvservice --explicit=\"\$_GROUP \$_MODE\"
sleep 1;

printf \"===> Resetting frame-buffer to %dx%dx%d...\\n\" \$_XRES \$_YRES \$_DEPTH
fbset --all --geometry \$_XRES \$_YRES \$_XRES \$_YRES \$_DEPTH -left 0 -right 0 -upper 0 -lower 0;
sleep 1;

if [ -f /boot/xinitrc ]
then
	ln -fs /boot/xinitrc /home/pi/.xinitrc;
	su - pi -c 'startx' &
fi

exit 0
" > /etc/rc.local

echo "
#!/bin/sh
while true; do

	# Clean up previously running apps, gracefully at first then harshly
	killall -TERM chromium 2>/dev/null;
	killall -TERM matchbox-window-manager 2>/dev/null;
	sleep 2;
	killall -9 chromium 2>/dev/null;
	killall -9 matchbox-window-manager 2>/dev/null;

	# Clean out existing profile information
	rm -rf /home/pi/.cache;
	rm -rf /home/pi/.config;
	rm -rf /home/pi/.pki;

	# Generate the bare minimum to keep Chromium happy!
	mkdir -p /home/pi/.config/chromium/Default
	sqlite3 /home/pi/.config/chromium/Default/Web\ Data \"CREATE TABLE meta(key LONGVARCHAR NOT NULL UNIQUE PRIMARY KEY, value LONGVARCHAR); INSERT INTO meta VALUES('version','46'); CREATE TABLE keywords (foo INTEGER);\";

	# Disable DPMS / Screen blanking
	xset -dpms
	xset s off

	# Reset the framebuffer's colour-depth
	fbset -depth \$( cat /sys/module/*fb*/parameters/fbdepth );

	# Hide the cursor (move it to the bottom-right, comment out if you want mouse interaction)
	xwit -root -warp \$( cat /sys/module/*fb*/parameters/fbwidth ) \$( cat /sys/module/*fb*/parameters/fbheight )

	# Start the window manager (remove "-use_cursor no" if you actually want mouse interaction)
	matchbox-window-manager -use_titlebar no -use_cursor no &

	# Start the browser (See http://peter.sh/experiments/chromium-command-line-switches/)
	sleep 10
	chromium  --app=http://bcit.recollect.net/DashboardAppliance/?id=$1

done;
" > /boot/xinitrc

echo "

disable_splash=1
disable_overscan=1
framebuffer_width=1920
framebuffer_height=1080
framebuffer_depth=32
framebuffer_ignore_alpha=1
hdmi_pixel_encoding=1
hdmi_group=2

" >> /boot/config.txt


echo "Raspberry pi $1 has been successfully configured."
