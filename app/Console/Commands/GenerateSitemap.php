<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/user/profile'))
            ->add(Url::create('/member'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully!');
    }
}
