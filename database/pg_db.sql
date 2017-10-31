--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: author; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE author (
    author_id integer NOT NULL,
    author_name character varying(255) NOT NULL
);


ALTER TABLE public.author OWNER TO stranger;

--
-- Name: author_author_id_seq; Type: SEQUENCE; Schema: public; Owner: stranger
--

CREATE SEQUENCE author_author_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.author_author_id_seq OWNER TO stranger;

--
-- Name: author_author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: stranger
--

ALTER SEQUENCE author_author_id_seq OWNED BY author.author_id;


--
-- Name: author_book; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE author_book (
    author_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE public.author_book OWNER TO stranger;

--
-- Name: book; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE book (
    book_id integer NOT NULL,
    book_name character varying(255) NOT NULL,
    book_description text NOT NULL,
    book_price numeric NOT NULL
);


ALTER TABLE public.book OWNER TO stranger;

--
-- Name: book_book_id_seq; Type: SEQUENCE; Schema: public; Owner: stranger
--

CREATE SEQUENCE book_book_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_book_id_seq OWNER TO stranger;

--
-- Name: book_book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: stranger
--

ALTER SEQUENCE book_book_id_seq OWNED BY book.book_id;


--
-- Name: genre; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE genre (
    genre_id integer NOT NULL,
    genre_name character varying(255) NOT NULL
);


ALTER TABLE public.genre OWNER TO stranger;

--
-- Name: genre_book; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE genre_book (
    genre_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE public.genre_book OWNER TO stranger;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE; Schema: public; Owner: stranger
--

CREATE SEQUENCE genre_genre_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.genre_genre_id_seq OWNER TO stranger;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: stranger
--

ALTER SEQUENCE genre_genre_id_seq OWNED BY genre.genre_id;


--
-- Name: order; Type: TABLE; Schema: public; Owner: stranger; Tablespace: 
--

CREATE TABLE "order" (
    order_id integer NOT NULL,
    order_book_id integer NOT NULL,
    order_addres character varying(255) NOT NULL,
    order_fio character varying NOT NULL,
    order_count integer NOT NULL,
    order_status integer DEFAULT 0 NOT NULL
);


ALTER TABLE public."order" OWNER TO stranger;

--
-- Name: order_order_id_seq; Type: SEQUENCE; Schema: public; Owner: stranger
--

CREATE SEQUENCE order_order_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_order_id_seq OWNER TO stranger;

--
-- Name: order_order_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: stranger
--

ALTER SEQUENCE order_order_id_seq OWNED BY "order".order_id;


--
-- Name: author_id; Type: DEFAULT; Schema: public; Owner: stranger
--

ALTER TABLE ONLY author ALTER COLUMN author_id SET DEFAULT nextval('author_author_id_seq'::regclass);


--
-- Name: book_id; Type: DEFAULT; Schema: public; Owner: stranger
--

ALTER TABLE ONLY book ALTER COLUMN book_id SET DEFAULT nextval('book_book_id_seq'::regclass);


--
-- Name: genre_id; Type: DEFAULT; Schema: public; Owner: stranger
--

ALTER TABLE ONLY genre ALTER COLUMN genre_id SET DEFAULT nextval('genre_genre_id_seq'::regclass);


--
-- Name: order_id; Type: DEFAULT; Schema: public; Owner: stranger
--

ALTER TABLE ONLY "order" ALTER COLUMN order_id SET DEFAULT nextval('order_order_id_seq'::regclass);


--
-- Data for Name: author; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY author (author_id, author_name) FROM stdin;
2	Бальзак
3	Толстой
4	Антонов
\.


--
-- Name: author_author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: stranger
--

SELECT pg_catalog.setval('author_author_id_seq', 1, false);


--
-- Data for Name: author_book; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY author_book (author_id, book_id) FROM stdin;
4	10
\.


--
-- Data for Name: book; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY book (book_id, book_name, book_description, book_price) FROM stdin;
10	монстры	2027 год	120.00
\.


--
-- Name: book_book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: stranger
--

SELECT pg_catalog.setval('book_book_id_seq', 1, false);


--
-- Data for Name: genre; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY genre (genre_id, genre_name) FROM stdin;
16	комедия
17	приключение
18	фантастика
23	роман
\.


--
-- Data for Name: genre_book; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY genre_book (genre_id, book_id) FROM stdin;
17	10
18	10
\.


--
-- Name: genre_genre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: stranger
--

SELECT pg_catalog.setval('genre_genre_id_seq', 1, false);


--
-- Data for Name: order; Type: TABLE DATA; Schema: public; Owner: stranger
--

COPY "order" (order_id, order_book_id, order_addres, order_fio, order_count, order_status) FROM stdin;
\.


--
-- Name: order_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: stranger
--

SELECT pg_catalog.setval('order_order_id_seq', 1, false);


--
-- Name: author_author_id; Type: CONSTRAINT; Schema: public; Owner: stranger; Tablespace: 
--

ALTER TABLE ONLY author
    ADD CONSTRAINT author_author_id PRIMARY KEY (author_id);


--
-- Name: book_book_id; Type: CONSTRAINT; Schema: public; Owner: stranger; Tablespace: 
--

ALTER TABLE ONLY book
    ADD CONSTRAINT book_book_id PRIMARY KEY (book_id);


--
-- Name: genre_genre_id; Type: CONSTRAINT; Schema: public; Owner: stranger; Tablespace: 
--

ALTER TABLE ONLY genre
    ADD CONSTRAINT genre_genre_id PRIMARY KEY (genre_id);


--
-- Name: order_order_id; Type: CONSTRAINT; Schema: public; Owner: stranger; Tablespace: 
--

ALTER TABLE ONLY "order"
    ADD CONSTRAINT order_order_id PRIMARY KEY (order_id);


--
-- Name: author_book_author_id; Type: INDEX; Schema: public; Owner: stranger; Tablespace: 
--

CREATE INDEX author_book_author_id ON author_book USING btree (author_id);


--
-- Name: author_book_book_id; Type: INDEX; Schema: public; Owner: stranger; Tablespace: 
--

CREATE INDEX author_book_book_id ON author_book USING btree (book_id);


--
-- Name: genre_book_book_id; Type: INDEX; Schema: public; Owner: stranger; Tablespace: 
--

CREATE INDEX genre_book_book_id ON genre_book USING btree (book_id);


--
-- Name: genre_book_genre_id; Type: INDEX; Schema: public; Owner: stranger; Tablespace: 
--

CREATE INDEX genre_book_genre_id ON genre_book USING btree (genre_id);


--
-- Name: order_order_book_id; Type: INDEX; Schema: public; Owner: stranger; Tablespace: 
--

CREATE INDEX order_order_book_id ON "order" USING btree (order_book_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

