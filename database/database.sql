-- Adminer 4.7.1 PostgreSQL dump

\connect "db_abipraya";

DROP TABLE IF EXISTS "sys_group";
DROP SEQUENCE IF EXISTS sys_group_id_seq;
CREATE SEQUENCE sys_group_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_group" (
    "id" integer DEFAULT nextval('sys_group_id_seq') NOT NULL,
    "name" character varying(16) NOT NULL,
    CONSTRAINT "sys_group_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "sys_group" ("id", "name") VALUES
(1,	'developer'),
(2,	'admin');

DROP TABLE IF EXISTS "sys_group_controller";
DROP SEQUENCE IF EXISTS sys_group_controller_id_seq;
CREATE SEQUENCE sys_group_controller_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_group_controller" (
    "id" integer DEFAULT nextval('sys_group_controller_id_seq') NOT NULL,
    "group" integer NOT NULL,
    "controller" character varying(64) NOT NULL,
    CONSTRAINT "sys_group_controller_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "sys_group_controller_ibfk_1" FOREIGN KEY ("group") REFERENCES sys_group(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

CREATE INDEX "sys_group_controller_group" ON "public"."sys_group_controller" USING btree ("group");

INSERT INTO "sys_group_controller" ("id", "group", "controller") VALUES
(1,	1,	'controller_management'),
(2,	1,	'menu_management'),
(3,	1,	'user_management'),
(4,	1,	'group_management'),
(5,	1,	'system_setting'),
(6,	1,	'database'),
(24,	2,	'pegawai_management');

DROP TABLE IF EXISTS "sys_menu";
DROP SEQUENCE IF EXISTS sys_menu_id_seq;
CREATE SEQUENCE sys_menu_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_menu" (
    "id" integer DEFAULT nextval('sys_menu_id_seq') NOT NULL,
    "group" integer NOT NULL,
    "alias" character varying(64) NOT NULL,
    "controller" character varying(64) NOT NULL,
    "method" text NOT NULL,
    "order" smallint NOT NULL,
    CONSTRAINT "sys_menu_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "sys_menu_ibfk_1" FOREIGN KEY ("group") REFERENCES sys_group(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

CREATE INDEX "sys_menu_group" ON "public"."sys_menu" USING btree ("group");

INSERT INTO "sys_menu" ("id", "group", "alias", "controller", "method", "order") VALUES
(1,	1,	'controller management',	'controller_management',	'[]',	2),
(2,	1,	'menu management',	'menu_management',	'[]',	3),
(3,	1,	'user management',	'user_management',	'[]',	1),
(4,	1,	'group management',	'group_management',	'[]',	0),
(5,	1,	'system setting',	'system_setting',	'[]',	6),
(6,	1,	'database',	'database',	'[]',	5),
(30,	2,	'Data Pegawai',	'pegawai_management',	'[]',	2);

DROP TABLE IF EXISTS "sys_message";
DROP SEQUENCE IF EXISTS sys_message_id_seq;
CREATE SEQUENCE sys_message_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_message" (
    "id" integer DEFAULT nextval('sys_message_id_seq') NOT NULL,
    "from" integer NOT NULL,
    "to" integer NOT NULL,
    "subject" character varying(255) NOT NULL,
    "content" text NOT NULL,
    "post_time" timestamp NOT NULL,
    "read" integer DEFAULT '0' NOT NULL,
    "trash" integer DEFAULT '0' NOT NULL,
    CONSTRAINT "sys_message_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "sys_setting";
DROP SEQUENCE IF EXISTS sys_setting_id_seq;
CREATE SEQUENCE sys_setting_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_setting" (
    "id" integer DEFAULT nextval('sys_setting_id_seq') NOT NULL,
    "key" character varying(64) NOT NULL,
    "type" text DEFAULT 'text' NOT NULL,
    "value" character varying(255) NOT NULL,
    CONSTRAINT "sys_setting_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "sys_setting" ("id", "key", "type", "value") VALUES
(4,	'admin-theme',	'text',	'default'),
(5,	'authorized only',	'boolean',	'0'),
(1,	'site name',	'text',	'Project Test Abipraya'),
(2,	'year',	'numeric',	'2019'),
(3,	'author',	'text',	'Ilyas Pratama');

DROP TABLE IF EXISTS "sys_user";
DROP SEQUENCE IF EXISTS sys_user_id_seq;
CREATE SEQUENCE sys_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."sys_user" (
    "id" integer DEFAULT nextval('sys_user_id_seq') NOT NULL,
    "group" integer NOT NULL,
    "name" text NOT NULL,
    "username" text NOT NULL,
    "email" text NOT NULL,
    "password" text NOT NULL,
    "token" text NOT NULL,
    "user" integer NOT NULL,
    CONSTRAINT "sys_user_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "sys_user_ibfk_1" FOREIGN KEY ("group") REFERENCES sys_group(id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

CREATE INDEX "sys_user_group" ON "public"."sys_user" USING btree ("group");

INSERT INTO "sys_user" ("id", "group", "name", "username", "email", "password", "token", "user") VALUES
(1,	1,	'dev',	'dev',	'dev@localhost.com',	'dev',	'9801c2dd16f519af46cbfa303e008cfc',	0),
(2,	2,	'admin default',	'admin',	'admin@localhost.com',	'admin',	'6c07a2aaa7404c549b5fc868487b29dc',	0);

DROP TABLE IF EXISTS "t_divisi";
DROP SEQUENCE IF EXISTS t_divisi_id_seq;
CREATE SEQUENCE t_divisi_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."t_divisi" (
    "id" integer DEFAULT nextval('t_divisi_id_seq') NOT NULL,
    "nama" text NOT NULL
) WITH (oids = false);

INSERT INTO "t_divisi" ("id", "nama") VALUES
(1,	'IT'),
(2,	'HRD');

DROP TABLE IF EXISTS "t_pegawai";
DROP SEQUENCE IF EXISTS t_pegawai_id_seq;
CREATE SEQUENCE t_pegawai_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."t_pegawai" (
    "id" integer DEFAULT nextval('t_pegawai_id_seq') NOT NULL,
    "divisi" integer NOT NULL,
    "nik" text NOT NULL,
    "nama" text NOT NULL,
    "alamat" text NOT NULL,
    "telephone" text NOT NULL,
    "status" integer NOT NULL,
    "user" integer,
    "date" date
) WITH (oids = false);

INSERT INTO "t_pegawai" ("id", "divisi", "nik", "nama", "alamat", "telephone", "status", "user", "date") VALUES
(13,	1,	'0836687',	'Data Pegawai Test',	'Jalan Patimura Kebayoran Baru Jakarta Selatan',	'0723843284',	1,	2,	'2019-03-18'),
(14,	2,	'087823749',	'Ilyas Pratama Test 2',	'Jalan Kembang Kenanangan, Kabupaten Bandung, Jawa Barat 40287',	'088234862',	1,	2,	'2019-03-18'),
(15,	2,	'67234298798',	'Data Pegawai 3',	'Jakarta Timur',	'07345349',	1,	2,	'2019-03-18');

-- 2019-03-18 15:11:07.71742+07
