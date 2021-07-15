@ECHO OFF 
set "VIDSOURCE"="rtsp://admin:HikVision2021@10.2.213.80:554/Streaming/Channels/101/"
rem set AUDIO_OPTS="-c:a aac -b:a 160000 -ac 2"
set "VIDEO_OPTS"="-s 854x480 -c:v libx264 -b:v 800000"
set "OUTPUT_HLS=-hls_time 10 -hls_list_size 10 -start_number 1"
start /b C:\Users\t700t\Documents\videoRecord\videoRecord\bin\Debug\ffmpeg.exe -v verbose -i rtsp://admin:HikVision2021@10.2.213.80:554/Streaming/Channels/101/ -y -s 854x480 -c:v libx264 -b:v 800000 -hls_time 5 -hls_list_size 5 -segment_time 5 -hls_flags delete_segments -start_number 1 stream.m3u8