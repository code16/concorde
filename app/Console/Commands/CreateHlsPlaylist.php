<?php

namespace App\Console\Commands;

use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateHlsPlaylist extends Command
{
    protected $signature = 'video:hls
                            {source : Path to the source mp4 file (local filesystem path)}
                            {--disk=s3 : Destination disk to store the HLS files}
                            {--output= : Output playlist path on the destination disk (defaults to <source-basename>/playlist.m3u8)}';

    protected $description = 'Create an X264 HLS playlist (480p, 720p, 1080p) from an mp4 file and store it on S3';

    public function handle(): int
    {
        $source = $this->argument('source');

        if (! is_file($source)) {
            $this->error("Source file not found: {$source}");

            return self::FAILURE;
        }

        $disk = $this->option('disk');
        $basename = pathinfo($source, PATHINFO_FILENAME);
        $output = $this->option('output') ?: "{$basename}/playlist.m3u8";

        $low = new X264('aac', 'libx264')->setKiloBitrate(1000);
        $mid = new X264('aac', 'libx264')->setKiloBitrate(2500);
        $high = new X264('aac', 'libx264')->setKiloBitrate(5000);

        $this->info("Generating HLS playlist for {$source} → disk [{$disk}] at {$output}");

        FFMpeg::open($source)
            ->exportForHLS()
            ->toDisk($disk)
            ->addFormat($low, function ($media) {
                $media->scale(854, 480);
            })
            ->addFormat($mid, function ($media) {
                $media->scale(1280, 720);
            })
            ->addFormat($high, function ($media) {
                $media->scale(1920, 1080);
            })
            ->save($output);

        $this->info('HLS playlist successfully created and uploaded.');

        return self::SUCCESS;
    }
}
