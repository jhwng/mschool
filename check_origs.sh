#!/bin/bash

origdir=/c/xampp/htdocs/promusic
chgdir=$1

#files=($(ls $chgdir))

cd $chgdir
files=($(ls))

#echo ${files[*]}

for f in ${files[*]}; do
  if [ -d $f ]; then
    #echo "directory"
    continue;
  fi

  echo "Checking $f ..."

  diff orig/$f $origdir/$f

  if [[ $? != 0 ]]; then
    echo "orig/$f is different from $origdir/$f !!!"
    exit 1
  fi
done

exit 0
