# Requirements and Schedule Postmortem #

## Features and Cuts ##

The following lists the major features that were listed in the original SRS along with whether the feature was completed or not. If it was cut, reasons were provided and an estimated time of work saved is listed.

| **Feature** | **Status** |
|:------------|:-----------|
| Social Connection | Completed |
| Track Your Library | Completed |
| Search for Media (i.e. Books) | Completed |
| Bartering System | Compeleted |
| Member and Item reviews | Cut due to time. Saved 10 persoon days |
| Protected User Profile | Cut due to irrelevance since we did a Facebook application. Saved 9 person days. |
| Favorite Members and Interest Groups	| Cut due to overlap with existing Facebook functionality and irrelevance. Saved 9 person days. |

The following lists some extra features that we implemented that were not part of the original SRS.

  * Show books only from your friends
  * Browse all the books that all your friends have to offer

The following table is a list of bonus features that we would have liked in version 2.0 and if we tried implementing them:

| **Bonus Features** | **Status** |
|:-------------------|:-----------|
| Show books based on locality | Not done due to locality data harder to get from user (some user don't want to disclose their location) and we now have functionality of showing books from friends, which we thought was more relevant. Would take estimated 5 person days. |
| Expansion to other media such as DVDs, video games, other physical media | Not done. Would take estimated 10 person days |
| Wanted section (what user want from others)	| Not done. Would take estimated 5 person days. |


---


## Task Assignments ##

The current roles of our team members are as follows:

| **Wei-Ting Lu**: Project Manager, Documentation Writer |
|:-------------------------------------------------------|
| **Greg Brandt**: Test Lead, Scripter |
| **Jedidiah Jonathan**: Tester, Documentation Writer |
| **Tatsuro Oya**: Tester, Diagram Maker |
| **Troy Martin**: Developer, Database Administrator |
| **James Parsons**: Developer, Documentation Writer |
| **John Wang**: Developer, UI |
| **Ken Inoue**: Developer, UI |

This was completely different from our original expectation, which was:

Front End: John, Greg, Tatsuro, Wei-Ting, Ken
Back End: Troy, Jedidiah, James

The disparity between the current roles and the roles from our original SRS can be attributed to the fact that in the beginning of the project, we really did not know how the project would turn out. The team structure was rearranged at Beta and has been stable since. Details of what each individual did since the zero feature release can be seen in the [Project Schedule](SystemArchitecture#Process.md) section of our Process Document.

As a team we feel that all of the time we spent working on this project made a valuable contribution to the application. We therefore do not feel we spent "too much time" on something or "too little time" on something. There were certainly surprises in the amount of time some aspects of the project took (i.e. Facebook Authentication Bug, see [issue 66](https://code.google.com/p/dawgsquad/issues/detail?id=66)), but the time spent getting these aspects of the application correct was well worth it. Some simpler tasks such as styling layout and changing wording were very time consuming; however, these tasks contributed greatly to the usability of our application. At the end we find ourselves wishing we had more time to implement some additional features, but we recognize that due to time constraints, having a fully functional, user friendly application is more important.