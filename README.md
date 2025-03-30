
# Apache config

```
	<Location /swagger-ui>
		AuthType Basic
                AuthName "Restricted Files"
                AuthBasicProvider file
                AuthUserFile "/var/www/html/urmetcloud/swagger-ui/.passwd"
                Require user developer brovotech vstream
        </Location>
```

# Add new user

- create the credentials
```
htpasswd .passwd <username>
```
- add username to "Require user " record in Location tag of apache configration
- set permisssions in user_tags.yaml








