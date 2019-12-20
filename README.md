- add an .env.local file at the root;
- update the DATABASE_URL variable in the .env.local file with the informations of the database;
- add the following variables (see https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#getting-started ) :
JWT_SECRET_KEY
JWT_PUBLIC_KEY
JWT_PASSPHRASE
WEBSITE_URL