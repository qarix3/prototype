# Video Tools

### Video Helper Tools

 A collection of utility programs for converting between various types of video files and encoding.

Tools list

- ffmpeg (using hardware encoder)
- youtube-dl (autoupdate)
- streamlink 
- hls.js

## Container: MP4

| - | YouTube recommends setting |
|---------------------|-------------------------------------------------|
| -movflags faststart | moov atom at the front of the file (Fast Start) |

## Video codec: H.264

| - | YouTube recommends setting | Note |
|---------------------|----------------------------|------|
| -c:v libx264 | H.264 | |
| -profile:v high | High Profile | |
| -bf 2 | 2 consecutive B frames | |
| | Closed GOP | x264 produces closed gop as default |
| -g 30 | GOP of **half the frame rate**. |  |
| | CABAC | Normally, x264 uses CABAC as an entropy encoder. |
| -crf 18 | Variable bitrate. | Currently, YouTube does not have a bitrate limit. Refer official document: https://support.google.com/youtube/answer/1722171?hl=en |
| -pix_fmt yuv420p | Chroma subsampling: 4:2:0 | If you like to encode HDR video, this comment might be helpful. https://gist.github.com/mikoim/27e4e0dc64e384adbcb91ff10a2d3678#gistcomment-2859601 |

## Audio codec: AAC-LC

| -                | YouTube recommends setting                              | Note |
|-----------------------------|---------------------------------------------------------|------|
| -c:a libfdk_aac -profile:a aac_low | AAC-LC| Fraunhofer FDK AAC is a high-quality codec library, but it does not compatible GPL. So your FFmpeg most likely does not contain it. Build FFmpeg manually or use a built-in AAC encoder instead of libfdk_aac. |
| -b:a 384| Mono 128 kbps, Stereo 384 kbps, 5.1	512 kbps | |

# Sample video
- 

# References
- Recommended upload encoding settings - YouTube Help https://support.google.com/youtube/answer/1722171
- Encode/H.264 – FFmpeg https://trac.ffmpeg.org/wiki/Encode/H.264
- Encode/AAC – FFmpeg https://trac.ffmpeg.org/wiki/Encode/AAC
- x264 FFmpeg Options Guide - Linux Encoding https://sites.google.com/site/linuxencoding/x264-ffmpeg-mapping