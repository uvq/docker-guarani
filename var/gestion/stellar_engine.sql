--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.15
-- Dumped by pg_dump version 11.6 (Debian 11.6-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET escape_string_warning = off;
SET row_security = off;

--
-- Name: stellar_data; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE stellar_data WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE stellar_data OWNER TO postgres;

\connect stellar_data

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET escape_string_warning = off;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: snapshot; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.snapshot (
    id integer NOT NULL,
    snapshot_name character varying(255) NOT NULL,
    project_name character varying(255) NOT NULL,
    hash character varying(32) NOT NULL,
    created_at timestamp without time zone,
    worker_pid integer
);


ALTER TABLE public.snapshot OWNER TO postgres;

--
-- Name: snapshot_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.snapshot_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.snapshot_id_seq OWNER TO postgres;

--
-- Name: table; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."table" (
    id integer NOT NULL,
    table_name character varying(255) NOT NULL,
    snapshot_id integer NOT NULL
);


ALTER TABLE public."table" OWNER TO postgres;

--
-- Name: table_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.table_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.table_id_seq OWNER TO postgres;

--
-- Data for Name: snapshot; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.snapshot (id, snapshot_name, project_name, hash, created_at, worker_pid) FROM stdin;
\.


--
-- Data for Name: table; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."table" (id, table_name, snapshot_id) FROM stdin;
\.


--
-- Name: snapshot_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.snapshot_id_seq', 1, true);


--
-- Name: table_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.table_id_seq', 1, true);


--
-- Name: snapshot snapshot_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.snapshot
    ADD CONSTRAINT snapshot_pkey PRIMARY KEY (id);


--
-- Name: table table_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."table"
    ADD CONSTRAINT table_pkey PRIMARY KEY (id);


--
-- Name: table table_snapshot_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."table"
    ADD CONSTRAINT table_snapshot_id_fkey FOREIGN KEY (snapshot_id) REFERENCES public.snapshot(id);


--
-- PostgreSQL database dump complete
--

