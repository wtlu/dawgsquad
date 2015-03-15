# Introduction #

This page contains the design rationale of our SRS and SDS

# Older Documents #

Older Versions of various documents at various milestones of the projects can be found here.

[SRS-Version 1](http://dawgsquad.googlecode.com/hg/docs/DAWGSquad_SRS-4-11-2011.zip)

[SDS-Version 1](http://dawgsquad.googlecode.com/hg/docs/DAWGSquad_SDS-4-22-2011.pdf)

In addition, our wiki is also version-controlled. If you'd like to see our documents in any release form, please consult the instructions below.

# Details of Changes #
## Changes from version 1 to Beta Release ##
Since version one, we have redefined our our product to be more realistic. We changed the schedule of the project to be more concise and clear. We also changed our risks and made them into tables.

For a individual changes on what we've changed from since SRS and SDS release in the Beta release please download the zip file (which contains diff of the different versions) below.

[Changes from Version 1 to Beta Release](https://dawgsquad.googlecode.com/hg/docs/DAWGSquad_DesignRationale.zip)

## Changes from Beta Release to Feature Complete Release ##

Since the Beta Release, we have changed the User Documentation images since our UI has updated since Beta release. We also changed the System architecture of SDS to indicate attribute values and what they mean (such as trade\_id or status of transactions table). We also deleted the assumption that user will only want to do either loan, sell, or trade since we changed our design so user can do any one of them.

In our developer documentation, we also updated our steps to build and test our application to be more concise.

In our SRS, we also updated our UI to reflect the current system.

# Older Version of D.A.W.G. Squad Wiki #

## How to Obtain Source Code ##
In addition to the above written statement of what has changed in our documentation, we also have older version of our wiki (which includes older versions of SRS, SDS, User, and Developer documents). If you have Mercurial installed, you can get these versions using the following command:

```
hg clone -u vVERSION https://wiki.dawgsquad.googlecode.com/hg/ dawgsquad-wiki 
```

Where VERSION is the version state you'd like to see. Please refer to our [releases](Releases.md) to find all the versions of our wiki. So if you want to want our wiki from our Zero Feature Release, you'd use the following command:

```
hg clone -u vzfr https://wiki.dawgsquad.googlecode.com/hg/ dawgsquad-wiki 
```

**NOTE** If you are getting certificate errors, then please put the --insecure flag after our command, like below:
```
hg clone -u vzfr https://wiki.dawgsquad.googlecode.com/hg/ dawgsquad-wiki --insecure
```