**Table of Contents**


---

# About Releasing/Updating to a New Version #

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
A table describing the versions can be found below.

# Releases #

| Release Version | Notes |
|:----------------|:------|
| 0.0 | Zero Feature Release |
| 0.5 | Adding Books Functionality Implemented |
| 0.6 | My Library Functionality Implemented |
| 0.7 | Beta Release: Login, Add Books, Find Books, My Library Stable |
| 0.7.1 | Updated install scripts for more automation|
| 0.7.2 | Updated install scripts so testing framework behaves correctly|
| 0.8 | Feature Complete Release - Transaction and Loan functions completed |
| 0.9 | Release Candidate |
| 1.0 | 1.0 Release: Added browse function |

# Wiki Releases #

| Release Version | Notes |
|:----------------|:------|
| srs | Software Requirements Specifications release of Wiki |
| sds | Software Design Specification milestone release of Wiki |
| zfr | Zero Feature Release version of Wiki |
| beta | Beta Version of Wiki |
| fc | Feature Complete Version of Wiki |
| rc | Release Candidate Version of Wiki |
| 1.0 | Release 1.0 Version of Wiki |