#!/bin/bash

svn log -v --xml .. > svn.log

java -jar statsvn.jar -verbose -output-dir svnstats -title "Development CMS" -exclude "buildtools/;core/PEAR/**;core/jpgraph/**" ./svn.log ..
