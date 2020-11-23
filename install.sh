curl -L https://yt-dl.org/downloads/latest/youtube-dl -o /usr/local/bin/youtube-dl

git clone https://git.videolan.org/git/ffmpeg/nv-codec-headers.git

cd nv-codec-headers && sudo make install && cd –

git clone https://git.ffmpeg.org/ffmpeg.git ffmpeg/

sudo apt-get install build-essential yasm cmake libtool libc6 libc6-dev unzip wget libnuma1 libnuma-dev

./configure --enable-nonfree -–enable-cuda-sdk –enable-libnpp --extra-cflags=-I/usr/local/cuda/include --extra-ldflags=-L/usr/local/cuda/lib64

make -j 8

sudo make install