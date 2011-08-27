/*Column Information For - medtechtrade.jos_adsmanager_ads*/
------------------------------------------------------------

FIELD                          TYPE                 COLLATION          NULL    KEY     DEFAULT  Extra           PRIVILEGES                       COMMENT
-----------------------------  -------------------  -----------------  ------  ------  -------  --------------  -------------------------------  -------
id                             INT(10) UNSIGNED     (NULL)             NO      PRI     (NULL)   AUTO_INCREMENT  SELECT,INSERT,UPDATE,REFERENCES         
category                       INT(10) UNSIGNED     (NULL)             YES             0                        SELECT,INSERT,UPDATE,REFERENCES         
section                        BIGINT(11) UNSIGNED  (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
userid                         INT(10) UNSIGNED     (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
NAME                           TEXT                 latin1_swedish_ci  YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
email                          TEXT                 latin1_swedish_ci  YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
rating                         INT(10)              (NULL)             YES             0                        SELECT,INSERT,UPDATE,REFERENCES         
ad_headline                    TEXT                 latin1_swedish_ci  YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_text                        TEXT                 latin1_swedish_ci  YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
date_created                   DATE                 (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
date_recall                    DATE                 (NULL)             YES             (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
recall_mail_sent               TINYINT(1)           (NULL)             YES             0                        SELECT,INSERT,UPDATE,REFERENCES         
views                          INT(10) UNSIGNED     (NULL)             YES             0                        SELECT,INSERT,UPDATE,REFERENCES         
published                      TINYINT(1)           (NULL)             YES             1                        SELECT,INSERT,UPDATE,REFERENCES         
ad_fabricante                  TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_type                        TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_modelo                      TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_serialnumber                TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_origen                      TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_catalognameornumber         TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_id                          TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_buildyear                   TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_estshippweight              TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_length                      TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_width                       TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_height                      TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_removaldifficulty           TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_riggingorremovalreq         TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_levelofshipmentpreparation  TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_boxsize                     TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_price                       TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_quality                     TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_currency                    TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_purchaseprice               TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_purchacecurrency            TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_adsmanual                   TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_offerorname                 TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_offerorpostal               TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_offerorcity                 TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_document                    TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
ad_quantity                    TEXT                 latin1_swedish_ci  NO              (NULL)                   SELECT,INSERT,UPDATE,REFERENCES         
