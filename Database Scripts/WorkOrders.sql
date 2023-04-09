CREATE DATABASE training;

CREATE SCHEMA cms;

CREATE TABLE cms.workorders
(
  id              serial PRIMARY KEY,
  contractor_name varchar(200) NOT NULL,
--         CONSTRAINT check_contractor_name(contractor_name ~* '^([A-Za-z .])+$'),
  wo_number       numeric(20)  NOT NULL,
--         CHECK ( REGEXP_LIKE(wo_number, '([A-Za-z0-9 /-])+') ),
  wo_date         date         NOT NULL
    CHECK ( wo_date < NOW()::date ),
  wo_desc         varchar(2000),
  cre_ts          timestamptz DEFAULT NOW()
);
