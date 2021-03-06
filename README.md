Calibre_opds
----------

# Information

However in case of the issues which appeared and also in light of Nextcloud 14 coming soon and no support for encryption on Nextcloud it might make sense to take the app from the store and rewrite it and better test it.

I am not a php developer not have developed any apps for Nextcloud before. So I don't know at the moment the answer to the issues.

I know the code doesn't look very good, doesn't have any tests and soon with version 14 it's not going to work at all without changes.

I really wished it would've worked out differently.
Because of personal circumstances I don't have that much time anymore to work on this actively so until a working version is there it might be Nextcloud 15 I believe.


# Known Restrictions 
* Not compatible with Nextcloud 14
* Not working with encryption enabled 


# About this app
The Calibre on Nextcloud  OPDS catalog app enables Nextcloud/Owncloud (*-cloud for the rest of this text) users to publish a Calibre Library as an OPDS feed. 

#### Calibre
The Calibre library is expected in the root directory, this file is parsed and all relevant Dublin Core metadata are parsed and as OPDS stream displayed. If a cover is specified in this file, and the relevant file is found in the directory, this cover is used as preview and thumbnail the file in the directory. 

#### Options
The feed is in compliance with the OPDS 1.1 specification according to the online OPDS validator (http://opds-validator.appspot.com/).

In the personal settings page there are options to enable/disable the feed (it is disabled by default), set the feed title, set the feed root directory for the user (the default is /Library), and more.

The admin settings page contains options to set the feed subtitle, the absolute path to the data directory for *-cloud and change the cover image and thumbnail dimensions.

The OPDS feed is disabled when the app is installed, enable it in the personal settings page under the header 'Calibre OPDS'. Every user has his/her own feed, which feed you get depends on which credentials you enter.

To connect to the OPDS feed, point your OPDS client at the app URL:

     https://example.com/path/to/nextcloud/index.php/apps/calibre_opds/

If all goes well, the client should ask for a username and password - enter your *-cloud credentials here (and make sure you use HTTPS!).

The feed has been tested on these clients:

 - Smultron on iOS: OK
 - TotalReader Pro on iOS: NOK (doesn't support authentication)
 
#### Credit:
* As I'm not a php developer and have never written any nextcloud application the files_opds was a helpful guide. https://github.com/Yetangitu/owncloud-apps/tree/master/files_opds

* COPS was the standalone php calibre opds server which I wanted to see in Nextcloud, all the brainwork comes from that repo: https://github.com/seblucas/cops

#### Contribution:
* Icon design by [dugite-code](https://github.com/dugite-code/) - thanks a lot
