# Scrapedeep

Originally from [Dan Devine](https://github.com/danieldevine). Scrapedeep is a replica of [Scrapeheap](https://github.com/danieldevine/scrapeheap) - A Web Content Scraping Tool

- [Scrapedeep](#scrapedeep)
  - [Overview](#overview)
  - [Instructions](#instructions)
  - [Latest Updates](#latest-updates)
  - [Local Deployment](#local-deployment)
  - [References](#references)

&nbsp;

## Overview

Get the url of the site you'd like to scrape content for. Content files will be generated for the pages of that site. The main body of text for the content is dumped WITHOUT any formatting (e.g. line breaks, font sizes, font styles ... etc.)

This project is suited for locally hosted websites. For instance, if you aim to alter the overall appearance of your site while keeping its content unchanged, this tool extracts the text content for you.

IMPORTANT: ensure you've disabled basic auth for the site you're scraping otherwise, this scraper won't work for it.

&nbsp;

## Instructions

Right now this version of scrapedeep is at it's infancy. Don't expect any fancy user interface. Just pop a URL in, pick what file type your content is going to be thrown into and expect results. These will be thrown into a folder called `output/`. Simple as that.

&nbsp;

## Latest Updates

1. See the dump of content as your scraper works
2. Saves HTML & MD files in separate folders
3. Adds some nice helpful text so if you want to scrape again, just go ahead

&nbsp;

## Local Deployment

1. Download/Clone the project
2. Install dependencies by running `composer install && npm install`
3. Ensure you put the project where your valet has been parked in
4. Access the project locally via Valet at http://scrapedeep.test

This assumes you have Valet installed and properly configured for your project. If not, please refer to the [Valet documentation](https://laravel.com/docs/10.x/valet) for setup instructions.

&nbsp;

## References

- We're using RoachPHP here: https://roach-php.dev/docs/introduction

- Check out Dan's original project on this: https://github.com/danieldevine/scrapedeep

- Here's a useful guide: https://codewithkyrian.com/p/roachphp-mastering-web-scraping-with-php