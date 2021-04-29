

## Erreur Semaphore extension (sysvsem) is required

pour réglé cette erreur, on va dans le fichier `.env` et change le `LOCK_DSN=semaphore` en `LOCK_DSN=flock`

Avant :

    ###> symfony/lock ###
    # Choose one of the stores below
    # postgresql+advisory://db_user:db_password@localhost/db_name
    LOCK_DSN=semaphore
    ###< symfony/lock ###

Après :

    ###> symfony/lock ###
    # Choose one of the stores below
    # postgresql+advisory://db_user:db_password@localhost/db_name
    LOCK_DSN=flock
    ###< symfony/lock ###