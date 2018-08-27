#!/bin/bash

# Start ssh agent cache
eval "$(ssh-agent -s)"

chmod 600 .travis/id_rsa    # Allow read access to the private key
ssh-add .travis/id_rsa      # Add the private key to SSH

git config --global push.default matching
git remote add deploy ssh://git@philipdb.com/srv/git/projects.philipdb.com.git
git push deploy production
