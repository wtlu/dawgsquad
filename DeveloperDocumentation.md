# SharingMedia Documentation - For Developers #

**Table of Contents**


---


## How to Obtain Source Code ##

The repository and latest stable version we use for development can be obtained by running command below, assuming Mercurial is installed on the machine:

```
hg clone -u v1.0 https://dawgsquad.googlecode.com/hg/ dawgsquad
```

The source code is hosted on the project wiki http://code.google.com/p/dawgsquad/.


---


## Directory Structure ##

In our root directory you will find various folders. The docs/ folder contains various images for our documentation located on our wiki

The tools/ folder contains various files such as testing scripts and setup scripts for developers

The sharingmedia/ folder is our application directory. Within the application directories are the app/, cake/, plugins/, and vendors/ directories. We will be developing our application within the app/ directory. Our tests are located in the app/tests directory. The other directories form the rest of the CakePHP framework, and will require little to no modification.

The following table outlines the folders within the app/ directory:

| config | config Holds the (few) configuration files CakePHP uses. Database connection details, bootstrapping, core configuration files and more should be stored here. |
|:-------|:--------------------------------------------------------------------------------------------------------------------------------------------------------------|
| controllers | controllers Contains the application’s controllers and their components. |
| libs | Contains 1st party libraries that do not come from 3rd parties or external vendors. This allows one to separate the organization's internal libraries from vendor libraries. |
| locale | Stores string files for internationalization. |
| models | Contains the application’s models, behaviors, and datasources. |
| plugins | Contains plugin packages. |
| tmp | This is where CakePHP stores temporary data. |
| tests | This is where unit and web tests are stored. |
| vendors | Any third-party classes or libraries should be placed here. |
| views | Presentational files are placed here: elements, error pages, helpers, layouts, and view files. |
| webroot | In a production setup, this folder should serve as the document root for your application. Folders here also serve as holding places for CSS stylesheets, images, and JavaScript files. |
<http://book.cakephp.org/view/899/CakePHP-Folder-Structure>

Documentation for developers can be obtained on the [project wiki](http://code.google.com/p/dawgsquad/).


---


## How to Build ##

### Server Setup ###

These directions assume a clean CSE Linux VM.

  1. Get the scripts using the following commands
```
   wget http://dawgsquad.googlecode.com/hg/tools/setup.tar.gz
   tar -zxvf setup.tar.gz
```
  1. Enter the following commands with administrator privileges
```
   sudo su
   sh ./INSTALL.sh
```
  1. Follow installation dialogue appropriately (NOTE: The following steps involve giving input to various parts of the setup process.)
    * Firewall Configuration for Apache Install:
      * Navigate with the arrow keys to the Firewall Enabled/Disabled checkbox, uncheck with a spacebar press.
      * Press Ok.
      * Press Yes to override firewall warning.
    * CPAN setup
      * Type in "yes" and press enter to let the script automatically run
  1. Ensure installation was successful by going to the following link on your web browser.
```
   http://localhost/dawgsquad/sharingmedia
```
    * If installed correctly, you will be redirected to the actual Facebook page on http://apps.facebook.com/sharingmedia/

### Facebook Setup ###

There is no need to compile the source code because PHP is an interpreted language. If LAMP is not installed and configured, it can be installed and configured using the provided script <INSTALL.sh>. The database can be configured by running provided SQL script <media\_db\_setup.sql> in MySQL with appropriate privileges. These files are in the tools/ directory of the repository, which can be obtained using the instructions in “How to Obtain Source Code”.

To set up the app on Facebook, follow these steps:

NOTE: If you're trying to continue developing SharingMedia with D.A.W.G. Squad, please contact Wei-Ting Lu at wtlu@uw.edu to get access to the application. If you want to set up a
completely new Facebook application, follow these steps.

  1. Make sure you have a Facebook account and are signed in
  1. Go to http://www.facebook.com/developers/apps.php
  1. Click on "Set up new app" at the top right corner of the page
  1. Provide an app name (e.g. SharingMedia), agree to the Facebook Terms, and click Create App
  1. Type in the words you see into the text field to security check
  1. In the next page, provide a description, icon, and add more users if needed
  1. Click on the "Web Site" tab on the left hand tool bar
  1. In the "Site URL" field, provide the site URL to the main page of the website on the server (e.g. http://yourdomain.com/dawgsquad/sharingmedia/)
  1. In the "Site Domain" field, provide the server's domain (e.g. yourdomain.com)
  1. Click on the "Facebook Integration" tab on the left hand tool
  1. In the "Canvas Page" field, enter what the application's URL should be in Facebook (e.g. http://apps.facebook.com/sharingmedia/)
  1. In the "Canvas URL" field, enter the URL where the canvas, or the main page of the app is located on the server. This is currently:
```
http://yourdomain.com/dawgsquad/sharingmedia/index.php/
```
> > Where yourdomain.com is the domain of your server.
  1. Click "Save Changes"

The app is now set up through Facebook. Go to the URL you provided in step 11 to see the application (e.g. http://apps.facebook.com/sharingmedia)


### (Optional) Manually/Force Update Build ###
  1. Please access your server (in our case we're assuming it's a CSE VM Linux Box, Fedora 13)
  1. Type the following:
```
cd /var/www/html/dawgsquad/
sudo hg fetch
```
  1. The build should be updated to the latest version of the repository


---


## How to Test ##

Testing will be performed with the SimpleTest framework. CakePHP’s testing framework is built upon that framework.

Tests are automated with the helper script TEST.pl. This script is written to be used with a specially formatted crontab (test.cron), and should not be run directly from the command line.

The crontab contains the following text:

```
HOME=/var/www/html/dawgsquad/sharingmedia/app/
0 0 * * * perl /var/www/html/dawgsquad/tools/TEST.pl -e YOUR_EMAIL_HERE
0 0 * * * sh /var/www/html/dawgsquad/tools/daily_build.sh
```

This runs the automated tests and daily build at midnight, every night. In order to receive test output, change YOUR\_EMAIL\_HERE to your email.

For information on how to use crontabs, please consult `man crontab`.

In order to interactively run the tests using CakePHP's test webpage format, navigate to

```
http://yourdomain.com/dawgsquad/sharingmedia/app/webroot/test.php
```

Then click on "Test Cases" under "App". Click on the test cases you want to perform on the right hand side of the screen.

**Note**: Do not use "Core Test Groups" test. These test cases are known by CakePHP to fail on the majority of applications.


---


## Automated Builds and Tests ##

Navigate to the dawgsquad/tools directory and load the crontab (which automates the tests nightly at midnight using the following commands)
```
cd /var/www/html/dawgsquad/tools
crontab test.cron
```

You should not see any output, the script is running in the background.

---


## Releasing a New Version ##

In order to update a particular version, all that must be done is executing the following commands in the application directory on the server (e.g. /var/www/html/sharingmedia/):

```
hg pull
hg update -r vX.X
```

Where X.X is the appropriate version number. For example, if one wanted to upgrade to v1.0, he would use the command:
```
hg update -r v1.0
```
There should not be conflicts during the update because no changes to the source should be made on the server.

In order to release a new version, developers will use the command hg tag --rev \**revisionNumber\** vX.X, where \**revisionNumber\** is the revision number you'd like to make a release on, and X.X is the newest version. For example, if you want to make a release version 0.7 on revision 06a3e9c7b927, you would use the command:
```
hg tag --rev 06a3e9c7b927 v0.7 
```
A table describing the versions can be found on our [Releases Table](Releases.md).
At each new release, the integrity of the links on the website will be checked using the W3C Link Checker at http://validator.w3.org/checklink .

We will also update the latest build to the documentation.


---


## Bugs ##

The list of bugs can be accessed by clicking the “Issues” tab of the wiki. Instructions on how to resolve bugs can be found at http://code.google.com/p/support/wiki/IssueTracker under “Quick Start”.