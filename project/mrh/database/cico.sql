--
-- PostgreSQL database dump
--

-- Dumped from database version 16.8 (Ubuntu 16.8-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 17.2 (Ubuntu 17.2-1.pgdg24.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: application_form; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.application_form (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    leave_type integer NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    total_hours double precision NOT NULL,
    leave_reason character varying(255) NOT NULL,
    verify_status boolean DEFAULT false NOT NULL,
    approved_by bigint,
    created_by bigint NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_by bigint,
    updated_at timestamp(0) with time zone NOT NULL
);


ALTER TABLE public.application_form OWNER TO postgres;

--
-- Name: application_form_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.application_form_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.application_form_id_seq OWNER TO postgres;

--
-- Name: application_form_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_form_id_seq OWNED BY public.application_form.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: check_in_out; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.check_in_out (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    date date NOT NULL,
    check_in time(0) without time zone NOT NULL,
    check_out time(0) without time zone,
    in_lack_time integer DEFAULT 0,
    out_lack_time integer DEFAULT 0,
    working_time double precision DEFAULT '0'::double precision,
    over_time double precision DEFAULT '0'::double precision,
    official_working_hours double precision DEFAULT '0'::double precision,
    paid_leave double precision DEFAULT '0'::double precision,
    unpaid_leave double precision DEFAULT '0'::double precision,
    status boolean DEFAULT true NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_at timestamp(0) with time zone NOT NULL,
    auto_add boolean DEFAULT false NOT NULL,
    leave_type integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.check_in_out OWNER TO postgres;

--
-- Name: check_in_out_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.check_in_out_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.check_in_out_id_seq OWNER TO postgres;

--
-- Name: check_in_out_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.check_in_out_id_seq OWNED BY public.check_in_out.id;


--
-- Name: days_off_by_schedule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.days_off_by_schedule (
    id bigint NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    leave_type integer NOT NULL,
    created_at timestamp(0) with time zone,
    updated_at timestamp(0) with time zone
);


ALTER TABLE public.days_off_by_schedule OWNER TO postgres;

--
-- Name: days_off_by_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.days_off_by_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.days_off_by_schedule_id_seq OWNER TO postgres;

--
-- Name: days_off_by_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.days_off_by_schedule_id_seq OWNED BY public.days_off_by_schedule.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: leave_days; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leave_days (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    days_off_in_advance double precision DEFAULT '0'::double precision NOT NULL,
    days_off double precision DEFAULT '0'::double precision NOT NULL,
    award_days_off double precision DEFAULT '0'::double precision NOT NULL,
    days_off_to_june double precision DEFAULT '0'::double precision NOT NULL,
    compensatory_day_off double precision DEFAULT '0'::double precision NOT NULL,
    carried_days_off double precision DEFAULT '0'::double precision NOT NULL,
    days_off_to_used double precision DEFAULT '0'::double precision NOT NULL,
    days_off_in_advance_to_used double precision DEFAULT '0'::double precision NOT NULL,
    year integer NOT NULL,
    created_at timestamp(0) with time zone,
    updated_at timestamp(0) with time zone
);


ALTER TABLE public.leave_days OWNER TO postgres;

--
-- Name: leave_days_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.leave_days_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.leave_days_id_seq OWNER TO postgres;

--
-- Name: leave_days_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.leave_days_id_seq OWNED BY public.leave_days.id;


--
-- Name: leave_days_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leave_days_log (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    days_off_in_advance double precision DEFAULT '0'::double precision NOT NULL,
    days_off double precision DEFAULT '0'::double precision NOT NULL,
    award_days_off double precision DEFAULT '0'::double precision NOT NULL,
    days_off_to_june double precision DEFAULT '0'::double precision NOT NULL,
    compensatory_day_off double precision DEFAULT '0'::double precision NOT NULL,
    carried_days_off double precision DEFAULT '0'::double precision NOT NULL,
    days_off_to_used double precision DEFAULT '0'::double precision NOT NULL,
    days_off_in_advance_to_used double precision DEFAULT '0'::double precision NOT NULL,
    pl_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    plan_pl_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    pl_in_advance_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    un_pl_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    sl_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    compensatory_day_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    all_pl_available_m double precision DEFAULT '0'::double precision NOT NULL,
    all_pl_to_used_m double precision DEFAULT '0'::double precision NOT NULL,
    all_pl_remain_to_use_m double precision DEFAULT '0'::double precision NOT NULL,
    date date NOT NULL,
    created_at timestamp(0) with time zone,
    updated_at timestamp(0) with time zone
);


ALTER TABLE public.leave_days_log OWNER TO postgres;

--
-- Name: leave_days_log_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.leave_days_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.leave_days_log_id_seq OWNER TO postgres;

--
-- Name: leave_days_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.leave_days_log_id_seq OWNED BY public.leave_days_log.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: overtime_form; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.overtime_form (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    date date NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    over_time double precision DEFAULT '0'::double precision,
    official_working_hours double precision DEFAULT '0'::double precision,
    paid_leave double precision DEFAULT '0'::double precision,
    total_time double precision NOT NULL,
    verify_status boolean NOT NULL,
    approved_by bigint,
    created_by bigint NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_by bigint,
    updated_at timestamp(0) with time zone NOT NULL
);


ALTER TABLE public.overtime_form OWNER TO postgres;

--
-- Name: overtime_form_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.overtime_form_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.overtime_form_id_seq OWNER TO postgres;

--
-- Name: overtime_form_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.overtime_form_id_seq OWNED BY public.overtime_form.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: project_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.project_users (
    id bigint NOT NULL,
    project_id bigint,
    user_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.project_users OWNER TO postgres;

--
-- Name: project_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.project_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.project_users_id_seq OWNER TO postgres;

--
-- Name: project_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.project_users_id_seq OWNED BY public.project_users.id;


--
-- Name: projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects (
    id bigint NOT NULL,
    project_name character varying(255),
    user_id bigint NOT NULL
);


ALTER TABLE public.projects OWNER TO postgres;

--
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.projects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.projects_id_seq OWNER TO postgres;

--
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.projects_id_seq OWNED BY public.projects.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: skill_category; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.skill_category (
    id bigint NOT NULL,
    code character varying(255),
    name character varying(255) NOT NULL,
    display_order integer DEFAULT 0 NOT NULL,
    is_featured boolean DEFAULT false NOT NULL,
    text_color character varying(255),
    bg_color character varying(255),
    description character varying(500),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.skill_category OWNER TO postgres;

--
-- Name: skill_category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.skill_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.skill_category_id_seq OWNER TO postgres;

--
-- Name: skill_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.skill_category_id_seq OWNED BY public.skill_category.id;


--
-- Name: skill_item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.skill_item (
    id bigint NOT NULL,
    category_id bigint NOT NULL,
    code character varying(255),
    name character varying(255) NOT NULL,
    display_order integer DEFAULT 0 NOT NULL,
    is_featured boolean DEFAULT false NOT NULL,
    text_color character varying(255),
    bg_color character varying(255),
    description character varying(500),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.skill_item OWNER TO postgres;

--
-- Name: skill_item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.skill_item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.skill_item_id_seq OWNER TO postgres;

--
-- Name: skill_item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.skill_item_id_seq OWNED BY public.skill_item.id;


--
-- Name: team_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.team_users (
    id bigint NOT NULL,
    team_id bigint,
    user_id bigint NOT NULL,
    role smallint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.team_users OWNER TO postgres;

--
-- Name: team_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.team_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.team_users_id_seq OWNER TO postgres;

--
-- Name: team_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.team_users_id_seq OWNED BY public.team_users.id;


--
-- Name: teams; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.teams (
    id bigint NOT NULL,
    team_name character varying(255)
);


ALTER TABLE public.teams OWNER TO postgres;

--
-- Name: teams_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.teams_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.teams_id_seq OWNER TO postgres;

--
-- Name: teams_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.teams_id_seq OWNED BY public.teams.id;


--
-- Name: user_skill_history; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_skill_history (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    skill json,
    description character varying(500),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.user_skill_history OWNER TO postgres;

--
-- Name: user_skill_history_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_skill_history_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_skill_history_id_seq OWNER TO postgres;

--
-- Name: user_skill_history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_skill_history_id_seq OWNED BY public.user_skill_history.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    role smallint DEFAULT '1'::smallint NOT NULL,
    email_verified_at timestamp(0) without time zone,
    join_date date,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    skill json,
    skill_updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: application_form id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_form ALTER COLUMN id SET DEFAULT nextval('public.application_form_id_seq'::regclass);


--
-- Name: check_in_out id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.check_in_out ALTER COLUMN id SET DEFAULT nextval('public.check_in_out_id_seq'::regclass);


--
-- Name: days_off_by_schedule id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.days_off_by_schedule ALTER COLUMN id SET DEFAULT nextval('public.days_off_by_schedule_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: leave_days id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days ALTER COLUMN id SET DEFAULT nextval('public.leave_days_id_seq'::regclass);


--
-- Name: leave_days_log id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days_log ALTER COLUMN id SET DEFAULT nextval('public.leave_days_log_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: overtime_form id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.overtime_form ALTER COLUMN id SET DEFAULT nextval('public.overtime_form_id_seq'::regclass);


--
-- Name: project_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_users ALTER COLUMN id SET DEFAULT nextval('public.project_users_id_seq'::regclass);


--
-- Name: projects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects ALTER COLUMN id SET DEFAULT nextval('public.projects_id_seq'::regclass);


--
-- Name: skill_category id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_category ALTER COLUMN id SET DEFAULT nextval('public.skill_category_id_seq'::regclass);


--
-- Name: skill_item id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_item ALTER COLUMN id SET DEFAULT nextval('public.skill_item_id_seq'::regclass);


--
-- Name: team_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.team_users ALTER COLUMN id SET DEFAULT nextval('public.team_users_id_seq'::regclass);


--
-- Name: teams id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teams ALTER COLUMN id SET DEFAULT nextval('public.teams_id_seq'::regclass);


--
-- Name: user_skill_history id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_skill_history ALTER COLUMN id SET DEFAULT nextval('public.user_skill_history_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: application_form; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.application_form (id, user_id, leave_type, start_date, end_date, start_time, end_time, total_hours, leave_reason, verify_status, approved_by, created_by, created_at, updated_by, updated_at) FROM stdin;
11	19	1	2025-01-09	2025-01-09	08:00:00	10:00:00	2	Em nghỉ phép.	t	16	19	2025-01-09 13:36:32+00	16	2025-01-09 13:37:17+00
12	11	1	2025-01-08	2025-01-08	08:00:00	10:00:00	2	Việc riêng / Private	f	\N	11	2025-01-09 14:58:14+00	11	2025-01-09 14:58:14+00
13	11	1	2025-01-09	2025-01-09	08:00:00	10:00:00	2	Việc riêng / Private	f	\N	11	2025-01-09 14:58:27+00	11	2025-01-09 14:58:27+00
9	23	1	2025-01-10	2025-01-10	08:00:00	17:00:00	8	Việc cá nhân / Private	t	6	23	2025-01-08 13:16:29+00	6	2025-01-10 12:54:21+00
14	7	1	2025-01-10	2025-01-10	08:00:00	10:00:00	2	việc riêng / private	t	6	7	2025-01-10 09:11:27+00	6	2025-01-10 12:54:21+00
15	23	2	2025-01-15	2025-01-15	08:00:00	17:00:00	8	Private / Việc cá nhân	t	6	23	2025-01-14 09:05:58+00	6	2025-01-22 09:47:09+00
17	8	1	2025-01-16	2025-01-16	08:00:00	10:00:00	2	private	t	6	8	2025-01-16 10:13:00+00	6	2025-01-22 09:47:09+00
19	7	1	2025-01-23	2025-01-23	08:00:00	17:00:00	8	việc riêng	t	6	7	2025-01-17 10:01:30+00	6	2025-01-22 09:47:09+00
20	5	1	2025-01-20	2025-01-20	08:00:00	10:00:00	2	Cá nhân	t	6	5	2025-01-20 09:54:12+00	6	2025-01-22 09:47:09+00
21	7	1	2025-01-20	2025-01-20	08:00:00	10:00:00	2	việc riêng	t	6	7	2025-01-20 10:00:30+00	6	2025-01-22 09:47:09+00
22	12	1	2025-01-21	2025-01-21	08:00:00	17:00:00	8	private	t	6	12	2025-01-22 09:46:11+00	6	2025-01-22 09:47:09+00
16	13	1	2025-01-15	2025-01-15	13:00:00	17:00:00	4	Em xin nghỉ buổi chiều 15/01/2025.	t	14	13	2025-01-15 11:59:25+00	14	2025-01-22 10:25:14+00
25	13	1	2025-01-03	2025-01-03	15:00:00	17:00:00	2	Em xin phép nghỉ 2 tiếng (15h00-17h00) buổi chiều ngày 03/01/2025.	t	14	13	2025-01-22 10:21:10+00	14	2025-01-22 10:25:14+00
27	9	1	2025-01-10	2025-01-10	15:00:00	17:00:00	2	private	t	6	9	2025-01-22 10:22:09+00	6	2025-01-22 10:26:53+00
32	8	1	2025-01-22	2025-01-22	08:00:00	10:00:00	2	private	t	6	8	2025-01-22 10:24:15+00	6	2025-01-22 10:26:53+00
33	9	1	2025-01-06	2025-01-06	08:00:00	17:00:00	8	private	t	6	9	2025-01-22 10:25:14+00	6	2025-01-22 10:26:53+00
34	9	1	2025-01-16	2025-01-16	15:00:00	17:00:00	2	private	t	6	9	2025-01-22 10:25:32+00	6	2025-01-22 10:26:53+00
35	24	1	2025-01-13	2025-01-13	13:00:00	17:00:00	4	personal leave	t	6	24	2025-01-22 10:25:37+00	6	2025-01-22 10:26:53+00
36	5	1	2025-01-06	2025-01-06	08:00:00	12:00:00	4	Cá nhân	f	\N	5	2025-01-22 10:29:30+00	5	2025-01-22 10:29:30+00
37	5	1	2025-01-07	2025-01-07	08:00:00	10:00:00	2	Cá nhân	f	\N	5	2025-01-22 10:29:59+00	5	2025-01-22 10:29:59+00
38	13	1	2025-01-22	2025-01-22	13:00:00	17:00:00	4	Em xin phép nghỉ chiều 22/01/2025.	t	14	13	2025-01-22 10:41:31+00	14	2025-01-22 10:45:31+00
39	11	1	2025-01-22	2025-01-22	08:00:00	12:00:00	4	Việc riêng - Private	f	\N	11	2025-01-22 13:36:43+00	11	2025-01-22 13:36:43+00
40	9	1	2025-01-22	2025-01-22	15:00:00	17:00:00	2	private	f	\N	9	2025-01-23 10:58:43+00	9	2025-01-23 10:58:43+00
41	22	1	2025-01-24	2025-01-24	15:00:00	17:00:00	2	Busy with personal work.	f	\N	22	2025-01-23 17:21:51+00	22	2025-01-23 17:21:51+00
42	9	1	2025-01-24	2025-01-24	15:00:00	17:00:00	2	private	f	\N	9	2025-01-24 15:03:19+00	9	2025-01-24 15:03:19+00
43	17	1	2025-02-04	2025-02-04	08:00:00	17:00:00	8	Nghỉ do có việc gia đình	t	16	17	2025-02-03 17:03:04+00	16	2025-02-03 17:14:05+00
44	13	1	2025-02-03	2025-02-03	08:00:00	17:00:00	8	Em xin phép nghỉ ngày 03/02/2025 ạ.	f	\N	13	2025-02-04 08:07:50+00	13	2025-02-04 08:07:50+00
45	5	1	2025-02-03	2025-02-03	08:00:00	17:00:00	8	Cá Nhân	f	\N	5	2025-02-04 11:21:05+00	5	2025-02-04 11:21:05+00
46	9	1	2025-02-04	2025-02-04	15:00:00	17:00:00	2	Private	f	\N	9	2025-02-04 16:15:37+00	9	2025-02-04 16:15:37+00
47	10	1	2025-02-05	2025-02-05	08:00:00	17:00:00	8	private family	f	\N	10	2025-02-06 08:11:56+00	10	2025-02-06 08:11:56+00
48	5	1	2025-02-06	2025-02-06	08:00:00	10:00:00	2	Cá nhân	f	\N	5	2025-02-06 10:07:08+00	5	2025-02-06 10:07:08+00
49	7	1	2025-02-06	2025-02-06	08:00:00	10:00:00	2	việc riêng	f	\N	7	2025-02-06 17:26:19+00	7	2025-02-06 17:26:19+00
50	7	1	2025-02-07	2025-02-07	08:00:00	10:00:00	2	việc riêng	f	\N	7	2025-02-07 10:00:33+00	7	2025-02-07 10:00:33+00
51	22	1	2025-02-07	2025-02-07	08:00:00	10:00:00	2	Busy with personal work.	f	\N	22	2025-02-07 15:23:52+00	22	2025-02-07 15:23:52+00
53	5	1	2025-02-10	2025-02-10	08:00:00	12:00:00	4	Cá nhân	f	\N	5	2025-02-11 13:20:15+00	5	2025-02-11 13:20:15+00
54	5	1	2025-02-11	2025-02-11	08:00:00	10:00:00	2	Cá nhân	f	\N	5	2025-02-12 10:06:54+00	5	2025-02-12 10:06:54+00
55	17	1	2025-02-12	2025-02-12	08:00:00	17:00:00	8	Nghỉ ốm	f	\N	17	2025-02-13 08:13:52+00	17	2025-02-13 08:13:52+00
56	15	1	2025-02-12	2025-02-12	08:00:00	17:00:00	8	Private leaving	f	\N	15	2025-02-13 09:09:42+00	15	2025-02-13 09:09:42+00
57	11	1	2025-02-19	2025-02-19	08:00:00	10:00:00	2	Private - Việc riêng	f	\N	11	2025-02-19 09:28:00+00	11	2025-02-19 09:28:00+00
58	5	1	2025-02-24	2025-02-24	08:00:00	12:00:00	4	Cá Nhân	f	\N	5	2025-02-24 12:47:30+00	5	2025-02-24 12:47:30+00
59	20	1	2025-02-26	2025-02-26	13:00:00	17:00:00	4	Do bận việc các nhân.\r\nPersonal leaving.	f	\N	20	2025-02-26 12:05:51+00	20	2025-02-26 12:05:51+00
61	12	1	2025-02-26	2025-02-26	08:00:00	17:00:00	8	nghỉ phép dư 2024	f	\N	12	2025-02-27 08:17:02+00	12	2025-02-27 08:17:02+00
62	25	1	2025-02-28	2025-02-28	08:00:00	17:00:00	8	Nghỉ bận việc cá nhân	f	\N	25	2025-02-27 08:18:00+00	25	2025-02-27 08:18:00+00
63	20	1	2025-02-27	2025-02-27	08:00:00	17:00:00	8	Do bận việc cá nhân.\r\nBusy with personal work.	f	\N	20	2025-02-28 09:05:43+00	20	2025-02-28 09:05:43+00
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
truongnx@bip.com|172.25.100.10:timer	i:1738717739;	1738717739
truongnx@bip.com|172.25.100.10	i:4;	1738717739
quanpl@bip.com.vn|172.25.100.10:timer	i:1738727947;	1738727947
quanpl@bip.com.vn|172.25.100.10	i:4;	1738727947
hqlinh040599@gmail.com|172.25.100.10:timer	i:1738890768;	1738890768
hqlinh040599@gmail.com|172.25.100.10	i:1;	1738890768
khanhbh@bip.com.vn|172.25.100.10:timer	i:1739269359;	1739269359
tranphuchong@bip.com.vn|172.25.100.10:timer	i:1737367385;	1737367385
tranphuchong@bip.com.vn|172.25.100.10	i:1;	1737367385
khanhbh@bip.com.vn|172.25.100.10	i:1;	1739269359
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: check_in_out; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.check_in_out (id, user_id, date, check_in, check_out, in_lack_time, out_lack_time, working_time, over_time, official_working_hours, paid_leave, unpaid_leave, status, created_at, updated_at, auto_add, leave_type) FROM stdin;
373	27	2024-12-31	17:03:00	17:03:00	483	0	0	0	0	0	0	t	2024-12-31 17:03:28+00	2024-12-31 17:03:44+00	f	0
374	5	2024-12-31	17:03:00	17:03:00	483	0	0	0	0	0	0	t	2024-12-31 17:03:46+00	2024-12-31 17:03:56+00	f	0
375	15	2024-12-31	17:04:00	17:04:00	484	0	0	0	0	0	0	t	2024-12-31 17:04:12+00	2024-12-31 17:04:17+00	f	0
377	20	2024-12-31	17:04:00	17:04:00	484	0	0	0	0	0	0	t	2024-12-31 17:04:35+00	2024-12-31 17:04:38+00	f	0
378	17	2024-12-31	17:04:00	17:04:00	484	0	0	0	0	0	0	t	2024-12-31 17:04:42+00	2024-12-31 17:04:45+00	f	0
376	29	2024-12-31	17:04:00	17:05:00	484	0	0	0	0	0	0	t	2024-12-31 17:04:31+00	2024-12-31 17:05:20+00	f	0
380	9	2024-12-31	17:07:00	17:07:00	487	0	0	0	0	0	0	t	2024-12-31 17:07:39+00	2024-12-31 17:07:43+00	f	0
381	23	2024-12-31	17:08:00	17:11:00	488	0	0	0	0	0	0	t	2024-12-31 17:08:36+00	2024-12-31 17:11:20+00	f	0
379	22	2024-12-31	17:05:00	17:11:00	485	0	0	0	0	0	0	t	2024-12-31 17:05:20+00	2024-12-31 17:11:55+00	f	0
372	6	2024-12-31	17:02:00	17:13:00	482	0	0	0	0	0	0	t	2024-12-31 17:02:56+00	2024-12-31 17:13:56+00	f	0
422	11	2025-01-03	10:00:00	18:09:00	120	0	6	0.5	6	0	0	t	2025-01-03 10:00:42+00	2025-01-03 18:09:00+00	f	0
402	18	2025-01-02	08:52:00	\N	52	0	0	0	0	0	0	t	2025-01-02 08:52:30+00	2025-01-02 08:52:30+00	f	0
389	29	2025-01-02	08:04:00	17:04:00	4	0	8	0	7.5	0	0	t	2025-01-02 08:04:16+00	2025-01-02 17:04:16+00	f	0
403	3	2025-01-02	11:30:00	\N	210	0	0	0	0	0	0	t	2025-01-02 11:30:12+00	2025-01-02 11:30:12+00	f	0
371	13	2024-12-31	17:01:00	17:19:00	481	0	0	0	0	0	0	t	2024-12-31 17:01:44+00	2024-12-31 17:19:08+00	f	0
368	11	2024-12-31	16:52:00	17:19:00	472	0	0	0	0.5	0	0	t	2024-12-31 16:52:39+00	2024-12-31 17:19:42+00	f	0
369	8	2024-12-31	17:00:00	17:21:00	480	0	0	0	0	0	0	t	2024-12-31 17:00:34+00	2024-12-31 17:21:22+00	f	0
370	14	2024-12-31	17:01:00	17:28:00	481	0	0	0	0	0	0	t	2024-12-31 17:01:24+00	2024-12-31 17:28:47+00	f	0
394	13	2025-01-02	08:13:00	17:04:00	13	0	8	0	7.5	0	0	t	2025-01-02 08:13:02+00	2025-01-02 17:04:49+00	f	0
392	24	2025-01-02	08:11:00	\N	11	0	0	0	0	0	0	t	2025-01-02 08:11:21+00	2025-01-02 08:11:21+00	f	0
400	11	2025-01-02	08:18:00	17:04:00	18	0	7.5	0	7.5	0	0	t	2025-01-02 08:18:47+00	2025-01-02 17:04:57+00	f	0
393	5	2025-01-02	08:12:00	17:05:00	12	0	8	0	7.5	0	0	t	2025-01-02 08:12:42+00	2025-01-02 17:05:09+00	f	0
390	20	2025-01-02	08:05:00	17:05:00	5	0	8	0	7.5	0	0	t	2025-01-02 08:05:43+00	2025-01-02 17:05:18+00	f	0
391	15	2025-01-02	08:10:00	17:08:00	10	0	8	0	7.5	0	0	t	2025-01-02 08:10:55+00	2025-01-02 17:08:05+00	f	0
398	4	2025-01-02	08:14:00	17:00:00	14	0	8	0	7.5	0	0	t	2025-01-02 08:14:54+00	2025-01-02 17:00:18+00	f	0
401	9	2025-01-02	08:24:00	17:00:00	24	0	7.5	0	7.5	0	0	t	2025-01-02 08:24:17+00	2025-01-02 17:00:53+00	f	0
384	17	2025-01-02	08:02:00	17:02:00	2	0	8	0	7.5	0	0	t	2025-01-02 08:02:19+00	2025-01-02 17:02:03+00	f	0
386	10	2025-01-02	08:03:00	17:02:00	3	0	8	0	7.5	0	0	t	2025-01-02 08:03:24+00	2025-01-02 17:02:26+00	f	0
383	19	2025-01-02	08:01:00	17:02:00	1	0	8	0	7.5	0	0	t	2025-01-02 08:01:55+00	2025-01-02 17:02:58+00	f	0
399	8	2025-01-02	08:15:00	17:04:00	15	0	8	0	7.5	0	0	t	2025-01-02 08:15:40+00	2025-01-02 17:04:02+00	f	0
395	6	2025-01-02	08:13:00	17:17:00	13	0	8	0	7.5	0	0	t	2025-01-02 08:13:33+00	2025-01-02 17:17:14+00	f	0
396	27	2025-01-02	08:13:00	17:23:00	13	0	8	0	7.5	0	0	t	2025-01-02 08:13:40+00	2025-01-02 17:23:18+00	f	0
397	12	2025-01-02	08:14:00	17:33:00	14	0	8	0	7.5	0	0	t	2025-01-02 08:14:21+00	2025-01-02 17:33:57+00	f	0
385	23	2025-01-02	08:03:00	17:36:00	3	0	8	0	7.5	0	0	t	2025-01-02 08:03:07+00	2025-01-02 17:36:16+00	f	0
387	22	2025-01-02	08:03:00	17:50:00	3	0	8	0.5	7.5	0	0	t	2025-01-02 08:03:39+00	2025-01-02 17:50:41+00	f	0
388	14	2025-01-02	08:03:00	18:08:00	3	0	8	0.5	7.5	0	0	t	2025-01-02 08:03:47+00	2025-01-02 18:08:00+00	f	0
419	18	2025-01-03	08:18:00	08:18:00	18	462	0	0	0	0	0	t	2025-01-03 08:18:29+00	2025-01-03 08:18:33+00	f	0
420	19	2025-01-03	08:18:00	\N	18	0	0	0	0	0	0	t	2025-01-03 08:18:35+00	2025-01-03 08:18:35+00	f	0
421	16	2025-01-03	08:23:00	\N	23	0	0	0	0	0	0	t	2025-01-03 08:23:35+00	2025-01-03 08:23:35+00	f	0
404	7	2025-01-03	07:57:00	18:12:00	0	0	8	0.5	8	0	0	f	2025-01-03 07:57:36+00	2025-01-22 10:26:24+00	f	0
409	4	2025-01-03	08:09:00	17:01:00	9	0	8	0	7.5	0	0	t	2025-01-03 08:09:40+00	2025-01-03 17:01:07+00	f	0
416	3	2025-01-03	08:17:00	17:01:00	17	0	7.5	0	7.5	0	0	t	2025-01-03 08:17:10+00	2025-01-03 17:01:15+00	f	0
415	8	2025-01-03	08:16:00	17:01:00	16	0	7.5	0	7.5	0	0	t	2025-01-03 08:16:40+00	2025-01-03 17:01:34+00	f	0
414	5	2025-01-03	08:15:00	17:05:00	15	0	8	0	7.5	0	0	t	2025-01-03 08:15:38+00	2025-01-03 17:05:59+00	f	0
405	9	2025-01-03	08:08:00	17:07:00	8	0	8	0	7.5	0	0	t	2025-01-03 08:08:43+00	2025-01-03 17:07:30+00	f	0
406	20	2025-01-03	08:08:00	17:08:00	8	0	8	0	7.5	0	0	t	2025-01-03 08:08:59+00	2025-01-03 17:08:48+00	f	0
407	15	2025-01-03	08:09:00	17:24:00	9	0	8	0	7.5	0	0	t	2025-01-03 08:09:01+00	2025-01-03 17:24:27+00	f	0
408	22	2025-01-03	08:09:00	17:22:00	9	0	8	0	7.5	0	0	t	2025-01-03 08:09:13+00	2025-01-03 17:22:43+00	f	0
410	29	2025-01-03	08:09:00	17:32:00	9	0	8	0	7.5	0	0	t	2025-01-03 08:09:55+00	2025-01-03 17:32:41+00	f	0
413	6	2025-01-03	08:15:00	17:38:00	15	0	8	0	7.5	0	0	t	2025-01-03 08:15:11+00	2025-01-03 17:38:27+00	f	0
382	7	2025-01-02	08:01:00	18:17:00	1	0	8	1	8	0	0	f	2025-01-02 08:01:20+00	2025-01-03 17:39:27+00	f	0
411	24	2025-01-03	08:10:00	17:45:00	10	0	8	0.5	7.5	0	0	t	2025-01-03 08:10:18+00	2025-01-03 17:45:59+00	f	0
412	14	2025-01-03	08:14:00	18:11:00	14	0	8	0.5	7.5	0	0	t	2025-01-03 08:14:14+00	2025-01-03 18:11:47+00	f	0
423	23	2025-01-03	13:24:00	18:12:00	264	0	3.5	0.5	4	0	0	t	2025-01-03 13:24:26+00	2025-01-03 18:12:13+00	f	0
936	6	2025-01-14	17:17:00	\N	497	0	0	0	0	0	0	t	2025-01-14 17:17:45+00	2025-01-14 17:17:45+00	f	0
424	10	2025-01-03	17:05:00	17:05:00	485	0	0	0	0	0	0	t	2025-01-03 17:05:53+00	2025-01-03 17:05:56+00	f	0
418	12	2025-01-03	08:17:00	17:53:00	17	0	7.5	0.5	7.5	0	0	t	2025-01-03 08:17:58+00	2025-01-03 17:53:12+00	f	0
458	8	2025-01-06	08:17:00	17:00:00	17	0	7.5	0	7.5	0	0	t	2025-01-06 08:17:01+00	2025-01-06 17:00:14+00	f	0
455	4	2025-01-06	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-01-06 08:15:09+00	2025-01-06 17:01:02+00	f	0
452	20	2025-01-06	08:14:00	17:01:00	14	0	8	0	7.5	0	0	t	2025-01-06 08:14:06+00	2025-01-06 17:01:11+00	f	0
450	10	2025-01-06	08:13:00	17:02:00	13	0	8	0	7.5	0	0	t	2025-01-06 08:13:16+00	2025-01-06 17:02:01+00	f	0
461	13	2025-01-06	08:26:00	17:02:00	26	0	7.5	0	7.5	0	0	t	2025-01-06 08:26:58+00	2025-01-06 17:02:21+00	f	0
451	22	2025-01-06	08:13:00	17:03:00	13	0	8	0	7.5	0	0	t	2025-01-06 08:13:51+00	2025-01-06 17:03:00+00	f	0
453	29	2025-01-06	08:14:00	17:10:00	14	0	8	0	7.5	0	0	t	2025-01-06 08:14:24+00	2025-01-06 17:10:52+00	f	0
462	17	2025-01-06	08:28:00	\N	28	0	0	0	0	0	0	t	2025-01-06 08:28:42+00	2025-01-06 08:28:42+00	f	0
425	13	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
426	25	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
428	14	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
429	4	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
430	12	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
431	23	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
432	17	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
433	6	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
434	27	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
435	10	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
436	19	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
437	20	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
438	24	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
439	5	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
440	3	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
441	18	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
456	6	2025-01-06	08:15:00	17:14:00	15	0	8	0	7.5	0	0	t	2025-01-06 08:15:21+00	2025-01-06 17:14:38+00	f	0
460	15	2025-01-06	08:17:00	17:18:00	17	0	7.5	0	7.5	0	0	t	2025-01-06 08:17:59+00	2025-01-06 17:18:14+00	f	0
454	24	2025-01-06	08:15:00	17:26:00	15	0	8	0	7.5	0	0	t	2025-01-06 08:15:00+00	2025-01-06 17:26:30+00	f	0
459	12	2025-01-06	08:17:00	17:35:00	17	0	7.5	0	7.5	0	0	t	2025-01-06 08:17:31+00	2025-01-06 17:35:10+00	f	0
780	14	2025-01-06	18:05:00	18:05:00	545	0	0	0.5	-1	0	0	t	2025-01-06 18:05:52+00	2025-01-06 18:05:56+00	f	0
457	23	2025-01-06	08:16:00	18:10:00	16	0	7.5	0.5	7.5	0	0	t	2025-01-06 08:16:16+00	2025-01-06 18:10:12+00	f	0
463	7	2025-01-06	08:31:00	18:17:00	31	0	7.25	1	7	0	0	t	2025-01-06 08:31:22+00	2025-01-06 18:17:25+00	f	0
789	19	2025-01-07	08:11:00	\N	11	0	0	0	0	0	0	t	2025-01-07 08:11:07+00	2025-01-07 08:11:07+00	f	0
801	26	2025-01-07	10:45:00	17:02:00	165	0	5.25	0	5	0	0	t	2025-01-07 10:45:01+00	2025-01-07 17:02:36+00	f	0
797	17	2025-01-07	08:28:00	17:04:00	28	0	7.5	0	7.5	0	0	t	2025-01-07 08:28:51+00	2025-01-07 17:04:20+00	f	0
799	15	2025-01-07	08:52:00	17:12:00	52	0	7	0	7	0	0	t	2025-01-07 08:52:42+00	2025-01-07 17:12:02+00	f	0
814	7	2025-01-08	08:10:00	17:13:00	10	0	8	0	7.5	0	0	t	2025-01-08 08:10:27+00	2025-01-08 17:13:33+00	f	0
866	17	2025-01-10	08:23:00	\N	23	0	0	0	0	0	0	t	2025-01-10 08:23:00+00	2025-01-10 08:23:00+00	f	0
842	4	2025-01-09	08:19:00	17:01:00	19	0	7.5	0	7.5	0	0	t	2025-01-09 08:19:07+00	2025-01-09 17:01:06+00	f	0
848	19	2025-01-09	13:19:00	17:04:00	259	0	3.5	0	4	2	0	t	2025-01-09 13:19:12+00	2025-01-09 17:04:17+00	f	0
828	22	2025-01-09	07:51:00	17:04:00	0	0	8	0	8	0	0	t	2025-01-09 07:51:02+00	2025-01-09 17:04:42+00	f	0
749	27	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
750	10	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
751	10	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
752	19	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
753	19	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
754	20	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
905	5	2025-01-13	08:12:00	17:06:00	12	0	8	0	7.5	0	0	t	2025-01-13 08:12:57+00	2025-01-13 17:06:43+00	f	0
923	13	2025-01-14	08:09:00	17:18:00	9	0	8	0	7.5	0	0	t	2025-01-14 08:09:45+00	2025-01-14 17:18:01+00	f	0
928	24	2025-01-14	08:15:00	17:29:00	15	0	8	0	7.5	0	0	t	2025-01-14 08:15:51+00	2025-01-14 17:29:19+00	f	0
950	9	2025-01-15	08:16:00	17:00:00	16	0	7.5	0	7.5	0	0	t	2025-01-15 08:16:16+00	2025-01-15 17:00:53+00	f	0
962	17	2025-01-16	08:04:00	\N	4	0	0	0	0	0	0	t	2025-01-16 08:04:18+00	2025-01-16 08:04:18+00	f	0
442	22	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
443	7	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
444	8	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
445	9	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
446	15	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
447	11	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
448	29	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
449	16	2025-01-04	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-05 06:30:02+00	2025-01-05 06:30:02+00	f	0
464	3	2025-01-06	09:28:00	17:01:00	88	0	6.5	0	6.5	0	0	t	2025-01-06 09:28:14+00	2025-01-06 17:01:31+00	f	0
467	19	2025-01-06	10:03:00	17:11:00	123	0	5.75	0	5.5	0	0	t	2025-01-06 10:03:45+00	2025-01-06 17:11:03+00	f	0
466	5	2025-01-06	09:57:00	18:06:00	117	0	6	0.5	6	0	0	t	2025-01-06 09:57:32+00	2025-01-06 18:06:01+00	f	0
465	11	2025-01-06	09:36:00	18:17:00	96	0	6.25	1	6	0	0	t	2025-01-06 09:36:43+00	2025-01-06 18:17:29+00	f	0
849	25	2025-01-09	13:34:00	\N	274	0	0	0	0	0	0	t	2025-01-09 13:34:45+00	2025-01-09 13:34:45+00	f	0
843	9	2025-01-09	08:21:00	17:00:00	21	0	7.5	0	7.5	0	0	t	2025-01-09 08:21:30+00	2025-01-09 17:00:07+00	f	0
829	15	2025-01-09	08:03:00	17:17:00	3	0	8	0	7.5	0	0	t	2025-01-09 08:03:20+00	2025-01-09 17:17:37+00	f	0
798	8	2025-01-07	08:45:00	17:01:00	45	0	7.25	0	7	0	0	t	2025-01-07 08:45:25+00	2025-01-07 17:01:13+00	f	0
781	10	2025-01-07	08:06:00	17:02:00	6	0	8	0	7.5	0	0	t	2025-01-07 08:06:07+00	2025-01-07 17:02:38+00	f	0
790	9	2025-01-07	08:12:00	17:09:00	12	0	8	0	7.5	0	0	t	2025-01-07 08:12:57+00	2025-01-07 17:09:45+00	f	0
802	5	2025-01-07	12:23:00	17:13:00	240	0	4	0	5	0	0	t	2025-01-07 12:23:39+00	2025-01-07 17:13:05+00	f	0
800	11	2025-01-07	10:06:00	17:43:00	126	0	5.75	0	5.5	0	0	t	2025-01-07 10:06:10+00	2025-01-07 17:43:17+00	f	0
815	10	2025-01-08	08:10:00	17:05:00	10	0	8	0	7.5	0	0	t	2025-01-08 08:10:47+00	2025-01-08 17:05:33+00	f	0
755	20	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
756	24	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
757	24	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
758	5	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
759	5	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
760	3	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
761	3	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
762	18	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
763	18	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
764	22	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
867	27	2025-01-10	08:23:00	18:48:00	23	0	7.5	1.5	7.5	0	0	t	2025-01-10 08:23:27+00	2025-01-10 18:48:55+00	f	0
906	12	2025-01-13	08:15:00	17:45:00	15	0	8	0.5	7.5	0	0	t	2025-01-13 08:15:52+00	2025-01-13 17:45:35+00	f	0
924	10	2025-01-14	08:12:00	17:04:00	12	0	8	0	7.5	0	0	t	2025-01-14 08:12:44+00	2025-01-14 17:04:07+00	f	0
937	14	2025-01-14	19:08:00	19:08:00	608	0	0	1.5	-2	0	0	t	2025-01-14 19:08:13+00	2025-01-14 19:08:15+00	f	0
951	7	2025-01-15	08:16:00	17:06:00	16	0	7.5	0	7.5	0	0	t	2025-01-15 08:16:57+00	2025-01-15 17:06:45+00	f	0
988	13	2025-01-17	08:06:00	17:02:00	6	0	8	0	7.5	0	0	t	2025-01-17 08:06:11+00	2025-01-17 17:02:13+00	f	0
963	24	2025-01-16	08:05:00	17:24:00	5	0	8	0	7.5	0	0	t	2025-01-16 08:05:45+00	2025-01-16 17:24:16+00	f	0
1024	10	2025-01-20	08:03:00	17:03:00	3	0	8	0	7.5	0	0	t	2025-01-20 08:03:28+00	2025-01-20 17:03:16+00	f	0
1036	12	2025-01-20	08:20:00	17:23:00	20	0	7.5	0	7.5	0	0	t	2025-01-20 08:20:52+00	2025-01-20 17:23:00+00	f	0
1080	23	2025-01-15	00:00:00	00:00:00	0	0	0	0	0	0	8	t	2025-01-22 09:47:09+00	2025-01-22 09:47:09+00	f	0
1059	8	2025-01-21	08:15:00	17:00:00	15	0	8	0	7.5	0	0	t	2025-01-21 08:37:01+00	2025-01-21 17:00:19+00	f	0
1048	23	2025-01-21	08:00:00	17:18:00	0	0	8	0	8	0	0	t	2025-01-21 08:00:05+00	2025-01-21 17:18:10+00	f	0
976	8	2025-01-16	10:00:00	17:00:00	120	0	6	0	6	2	0	t	2025-01-16 10:10:14+00	2025-01-22 09:47:09+00	f	0
1081	7	2025-01-23	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-22 09:47:09+00	2025-01-22 09:47:09+00	f	0
1082	12	2025-01-21	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-22 09:47:09+00	2025-01-22 09:47:09+00	f	0
1069	15	2025-01-22	08:09:00	17:09:00	9	0	8	0	7.5	0	0	t	2025-01-22 08:09:54+00	2025-01-22 17:09:04+00	f	0
1102	3	2025-01-23	09:06:00	17:01:00	66	0	6.75	0	6.5	0	0	t	2025-01-23 09:06:41+00	2025-01-23 17:01:45+00	f	0
1113	23	2025-01-24	08:24:00	\N	24	0	0	0	0	0	0	t	2025-01-24 08:24:19+00	2025-01-24 08:24:19+00	f	0
1091	23	2025-01-23	08:01:00	17:11:00	1	0	8	0	7.5	0	0	t	2025-01-23 08:01:38+00	2025-01-23 17:11:40+00	f	0
1181	4	2025-02-03	08:13:00	17:02:00	13	0	8	0	7.5	0	0	t	2025-02-03 08:13:57+00	2025-02-03 17:02:36+00	f	0
1171	24	2025-02-03	07:57:00	17:12:00	0	0	8	0	8	0	0	t	2025-02-03 07:57:33+00	2025-02-03 17:12:10+00	f	0
1190	17	2025-02-04	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-02-03 17:14:05+00	2025-02-03 17:14:05+00	f	0
791	29	2025-01-07	08:13:00	17:04:00	13	0	8	0	7.5	0	0	t	2025-01-07 08:13:06+00	2025-01-07 17:04:07+00	f	0
788	23	2025-01-07	08:11:00	17:07:00	11	0	8	0	7.5	0	0	t	2025-01-07 08:11:03+00	2025-01-07 17:07:08+00	f	0
782	20	2025-01-07	08:06:00	17:08:00	6	0	8	0	7.5	0	0	t	2025-01-07 08:06:58+00	2025-01-07 17:08:16+00	f	0
816	9	2025-01-08	08:13:00	18:04:00	13	0	8	0.5	7.5	0	0	t	2025-01-08 08:13:59+00	2025-01-08 18:04:23+00	f	0
830	20	2025-01-09	08:03:00	17:03:00	3	0	8	0	7.5	0	0	t	2025-01-09 08:03:56+00	2025-01-09 17:03:51+00	f	0
844	12	2025-01-09	08:25:00	17:40:00	25	0	7.5	0	7.5	0	0	t	2025-01-09 08:25:08+00	2025-01-09 17:40:46+00	f	0
847	11	2025-01-09	09:51:00	18:09:00	111	0	6	0.5	6	0	0	t	2025-01-09 09:51:22+00	2025-01-09 18:09:56+00	f	0
1191	424	2025-02-03	17:16:00	17:17:00	496	0	0	0	0	0	0	t	2025-02-03 17:16:04+00	2025-02-03 17:17:36+00	f	0
1172	22	2025-02-03	08:00:00	17:20:00	0	0	8	0	8	0	0	t	2025-02-03 08:00:27+00	2025-02-03 17:20:16+00	f	0
907	22	2025-01-13	08:16:00	17:13:00	16	0	7.5	0	7.5	0	0	t	2025-01-13 08:16:05+00	2025-01-13 17:13:28+00	f	0
925	7	2025-01-14	08:12:00	17:52:00	12	0	8	0.5	7.5	0	0	t	2025-01-14 08:12:53+00	2025-01-14 17:52:02+00	f	0
938	22	2025-01-15	07:58:00	17:00:00	0	0	8	0	8	0	0	t	2025-01-15 07:58:57+00	2025-01-15 17:00:34+00	f	0
1271	29	2025-02-07	08:18:00	17:05:00	18	0	7.5	0	7.5	0	0	t	2025-02-07 08:18:37+00	2025-02-07 17:05:07+00	f	0
952	11	2025-01-15	08:18:00	18:31:00	18	0	7.5	1	7.5	0	0	t	2025-01-15 08:18:16+00	2025-01-15 18:31:44+00	f	0
975	27	2025-01-16	08:51:00	17:07:00	51	0	7	0	7	0	0	t	2025-01-16 08:51:31+00	2025-01-16 17:07:18+00	f	0
964	22	2025-01-16	08:05:00	17:15:00	5	0	8	0	7.5	0	0	t	2025-01-16 08:05:48+00	2025-01-16 17:15:59+00	f	0
989	23	2025-01-17	08:10:00	\N	10	0	0	0	0	0	0	t	2025-01-17 08:10:50+00	2025-01-17 08:10:50+00	f	0
1025	26	2025-01-20	08:03:00	17:03:00	3	0	8	0	7.5	0	0	t	2025-01-20 08:03:35+00	2025-01-20 17:03:41+00	f	0
1037	27	2025-01-20	08:23:00	17:07:00	23	0	7.5	0	7.5	0	0	t	2025-01-20 08:23:00+00	2025-01-20 17:07:44+00	f	0
1049	26	2025-01-21	08:02:00	17:05:00	2	0	8	0	7.5	0	0	t	2025-01-21 08:02:24+00	2025-01-21 17:05:54+00	f	0
1060	27	2025-01-21	08:56:00	17:18:00	56	0	7	0	7	0	0	t	2025-01-21 08:56:34+00	2025-01-21 17:18:12+00	f	0
868	7	2025-01-10	09:07:00	17:03:00	67	0	6.75	0	6	2	0	f	2025-01-10 09:07:41+00	2025-01-22 10:26:24+00	f	0
1182	7	2025-02-03	08:14:00	17:41:00	14	0	8	0	7.5	0	0	t	2025-02-03 08:14:23+00	2025-02-03 17:41:29+00	f	0
1083	8	2025-01-22	10:18:00	17:00:00	138	0	5.5	0	5.5	2	0	t	2025-01-22 10:18:23+00	2025-01-22 17:00:49+00	f	0
1070	5	2025-01-22	08:10:00	17:03:00	10	0	8	0	7.5	0	0	t	2025-01-22 08:10:59+00	2025-01-22 17:03:31+00	f	0
1103	8	2025-01-23	17:00:00	17:00:00	480	0	0	0	0	0	0	t	2025-01-23 17:00:19+00	2025-01-23 17:00:20+00	f	0
1092	29	2025-01-23	08:08:00	17:02:00	8	0	8	0	7.5	0	0	t	2025-01-23 08:08:15+00	2025-01-23 17:02:26+00	f	0
1114	7	2025-01-24	08:31:00	\N	31	0	0	0	0	0	0	t	2025-01-24 08:31:12+00	2025-01-24 08:31:12+00	f	0
1265	15	2025-02-07	08:11:00	17:15:00	11	0	8	0	7.5	0	0	t	2025-02-07 08:11:59+00	2025-02-07 17:15:25+00	f	0
1207	4	2025-02-04	08:08:00	17:01:00	8	0	8	0	7.5	0	0	t	2025-02-04 08:08:59+00	2025-02-04 17:01:06+00	f	0
1199	24	2025-02-04	08:04:00	17:18:00	4	0	8	0	7.5	0	0	t	2025-02-04 08:04:51+00	2025-02-04 17:18:03+00	f	0
1198	22	2025-02-04	08:04:00	18:26:00	4	0	8	1	7.5	0	0	t	2025-02-04 08:04:17+00	2025-02-04 18:26:25+00	f	0
1230	9	2025-02-05	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-02-05 08:15:05+00	2025-02-05 17:01:55+00	f	0
1222	24	2025-02-05	08:09:00	17:29:00	9	0	8	0	7.5	0	0	t	2025-02-05 08:09:22+00	2025-02-05 17:29:17+00	f	0
1252	13	2025-02-06	08:19:00	17:04:00	19	0	7.5	0	7.5	0	0	t	2025-02-06 08:19:03+00	2025-02-06 17:04:51+00	f	0
1277	22	2025-02-07	09:38:00	17:38:00	98	0	6.25	0	6	0	0	t	2025-02-07 09:38:09+00	2025-02-07 17:38:21+00	f	0
1244	424	2025-02-06	08:11:00	17:30:00	11	0	8	0	7.5	0	0	t	2025-02-06 08:11:51+00	2025-02-06 17:30:08+00	f	0
1302	14	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1303	15	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1304	505	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1305	20	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1306	992	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1307	22	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1317	9	2025-02-10	08:12:00	17:02:00	12	0	8	0	7.5	0	0	t	2025-02-10 08:12:22+00	2025-02-10 17:02:07+00	f	0
1322	13	2025-02-10	08:17:00	17:07:00	17	0	7.5	0	7.5	0	0	t	2025-02-10 08:17:27+00	2025-02-10 17:07:18+00	f	0
1312	15	2025-02-10	08:07:00	17:40:00	7	0	8	0	7.5	0	0	t	2025-02-10 08:07:04+00	2025-02-10 17:40:48+00	f	0
1327	18	2025-02-10	13:59:00	17:45:00	299	0	3	0.5	3.5	0	0	t	2025-02-10 13:59:56+00	2025-02-10 17:45:15+00	f	0
1347	3	2025-02-11	13:03:00	13:03:00	243	237	0	0	0	0	0	t	2025-02-11 13:03:55+00	2025-02-11 13:03:58+00	f	0
1337	9	2025-02-11	08:12:00	17:01:00	12	0	8	0	7.5	0	0	t	2025-02-11 08:12:23+00	2025-02-11 17:01:52+00	f	0
1342	17	2025-02-11	08:20:00	17:04:00	20	0	7.5	0	7.5	0	0	t	2025-02-11 08:20:20+00	2025-02-11 17:04:12+00	f	0
1332	22	2025-02-11	08:09:00	17:09:00	9	0	8	0	7.5	0	0	t	2025-02-11 08:09:08+00	2025-02-11 17:09:45+00	f	0
1357	18	2025-02-12	08:10:00	17:22:00	10	0	8	0	7.5	0	0	t	2025-02-12 08:10:48+00	2025-02-12 17:22:09+00	f	0
1362	11	2025-02-12	08:18:00	18:12:00	18	0	7.5	0.5	7.5	0	0	t	2025-02-12 08:18:10+00	2025-02-12 18:12:38+00	f	0
792	3	2025-01-07	08:15:00	\N	15	0	0	0	0	0	0	t	2025-01-07 08:15:22+00	2025-01-07 08:15:22+00	f	0
803	27	2025-01-07	17:11:00	17:11:00	491	0	0	0	0	0	0	t	2025-01-07 17:11:36+00	2025-01-07 17:11:39+00	f	0
783	22	2025-01-07	08:07:00	17:24:00	7	0	8	0	7.5	0	0	t	2025-01-07 08:07:39+00	2025-01-07 17:24:27+00	f	0
817	6	2025-01-08	08:15:00	17:18:00	15	0	8	0	7.5	0	0	t	2025-01-08 08:15:59+00	2025-01-08 17:18:50+00	f	0
831	24	2025-01-09	08:04:00	17:10:00	4	0	8	0	7.5	0	0	t	2025-01-09 08:04:15+00	2025-01-09 17:10:02+00	f	0
845	7	2025-01-09	08:25:00	18:07:00	25	0	7.5	0.5	7.5	0	0	t	2025-01-09 08:25:14+00	2025-01-09 18:07:48+00	f	0
869	11	2025-01-10	10:12:00	\N	132	0	0	0	0	0	0	t	2025-01-10 10:12:22+00	2025-01-10 10:12:22+00	f	0
850	22	2025-01-10	07:57:00	17:03:00	0	0	8	0	8	0	0	t	2025-01-10 07:57:16+00	2025-01-10 17:03:30+00	f	0
908	13	2025-01-13	08:16:00	17:06:00	16	0	7.5	0	7.5	0	0	t	2025-01-13 08:16:14+00	2025-01-13 17:06:52+00	f	0
1200	29	2025-02-04	08:05:00	\N	5	0	0	0	0	0	0	t	2025-02-04 08:05:30+00	2025-02-04 08:05:30+00	f	0
926	9	2025-01-14	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-01-14 08:15:22+00	2025-01-14 17:01:02+00	f	0
953	4	2025-01-15	08:19:00	17:06:00	19	0	7.5	0	7.5	0	0	t	2025-01-15 08:19:49+00	2025-01-15 17:06:13+00	f	0
939	24	2025-01-15	08:01:00	17:20:00	1	0	8	0	7.5	0	0	t	2025-01-15 08:01:16+00	2025-01-15 17:20:03+00	f	0
977	19	2025-01-16	17:09:00	17:09:00	489	0	0	0	0	0	0	t	2025-01-16 17:09:01+00	2025-01-16 17:09:05+00	f	0
965	10	2025-01-16	08:06:00	17:23:00	6	0	8	0	7.5	0	0	t	2025-01-16 08:06:24+00	2025-01-16 17:23:50+00	f	0
990	22	2025-01-17	08:11:00	17:25:00	11	0	8	0	7.5	0	0	t	2025-01-17 08:11:08+00	2025-01-17 17:25:13+00	f	0
1026	20	2025-01-20	08:04:00	17:30:00	4	0	8	0	7.5	0	0	t	2025-01-20 08:04:18+00	2025-01-20 17:30:12+00	f	0
1038	8	2025-01-20	08:15:00	18:00:00	15	0	8	0.5	7.5	0	0	t	2025-01-20 08:46:12+00	2025-01-20 18:00:19+00	f	0
1050	20	2025-01-21	08:04:00	17:02:00	4	0	8	0	7.5	0	0	t	2025-01-21 08:04:38+00	2025-01-21 17:02:18+00	f	0
1061	15	2025-01-21	09:23:00	17:15:00	83	0	6.5	0	6.5	0	0	t	2025-01-21 09:23:07+00	2025-01-21 17:15:54+00	f	0
417	13	2025-01-03	08:17:00	15:18:00	17	102	6	0	5.5	2	0	t	2025-01-03 08:17:31+00	2025-01-22 10:25:14+00	f	0
1071	7	2025-01-22	08:12:00	18:32:00	12	0	8	1	7.5	0	0	t	2025-01-22 08:12:55+00	2025-01-22 18:32:53+00	f	0
1093	5	2025-01-23	08:10:00	17:02:00	10	0	8	0	7.5	0	0	t	2025-01-23 08:10:22+00	2025-01-23 17:02:59+00	f	0
1104	15	2025-01-23	17:31:00	17:31:00	511	0	0	0	-0.5	0	0	t	2025-01-23 17:31:40+00	2025-01-23 17:31:41+00	f	0
1115	26	2025-01-24	08:34:00	17:01:00	34	0	7.25	0	7	0	0	t	2025-01-24 08:34:24+00	2025-01-24 17:01:03+00	f	0
1175	20	2025-02-03	08:04:00	17:20:00	4	0	8	0	7.5	0	0	t	2025-02-03 08:04:04+00	2025-02-03 17:20:31+00	f	0
1208	16	2025-02-04	08:09:00	17:05:00	9	0	8	0	7.5	0	0	t	2025-02-04 08:09:08+00	2025-02-04 17:05:05+00	f	0
1173	23	2025-02-03	08:01:00	17:52:00	1	0	8	0.5	7.5	0	0	t	2025-02-03 08:01:00+00	2025-02-03 17:52:12+00	f	0
1183	11	2025-02-03	08:17:00	17:59:00	17	0	7.5	0.5	7.5	0	0	t	2025-02-03 08:17:16+00	2025-02-03 17:59:24+00	f	0
1215	20	2025-02-05	08:06:00	17:03:00	6	0	8	0	7.5	0	0	t	2025-02-05 08:06:14+00	2025-02-05 17:03:30+00	f	0
1223	29	2025-02-05	08:10:00	17:04:00	10	0	8	0	7.5	0	0	t	2025-02-05 08:10:37+00	2025-02-05 17:04:40+00	f	0
1231	27	2025-02-05	08:17:00	17:05:00	17	0	7.5	0	7.5	0	0	t	2025-02-05 08:17:01+00	2025-02-05 17:05:45+00	f	0
1253	25	2025-02-06	08:22:00	17:30:00	22	0	7.5	0	7.5	0	0	t	2025-02-06 08:22:09+00	2025-02-06 17:30:25+00	f	0
1245	6	2025-02-06	08:12:00	20:07:00	12	0	8	2	7.5	0	0	t	2025-02-06 08:12:10+00	2025-02-06 20:07:18+00	f	0
1266	9	2025-02-07	08:12:00	17:01:00	12	0	8	0	7.5	0	0	t	2025-02-07 08:12:36+00	2025-02-07 17:01:15+00	f	0
1278	7	2025-02-07	09:59:00	17:03:00	119	0	6	0	6	0	0	t	2025-02-07 09:59:56+00	2025-02-07 17:03:59+00	f	0
1272	12	2025-02-07	08:20:00	18:05:00	20	0	7.5	0.5	7.5	0	0	t	2025-02-07 08:20:18+00	2025-02-07 18:05:03+00	f	0
1313	4	2025-02-10	08:07:00	17:01:00	7	0	8	0	7.5	0	0	t	2025-02-10 08:07:56+00	2025-02-10 17:01:55+00	f	0
1308	26	2025-02-10	07:53:00	17:06:00	0	0	8	0	8	0	0	t	2025-02-10 07:53:01+00	2025-02-10 17:06:19+00	f	0
1318	5	2025-02-10	08:13:00	17:08:00	13	0	8	0	7.5	0	0	t	2025-02-10 08:13:05+00	2025-02-10 17:08:24+00	f	0
1323	6	2025-02-10	08:20:00	17:25:00	20	0	7.5	0	7.5	0	0	t	2025-02-10 08:20:10+00	2025-02-10 17:25:37+00	f	0
1333	29	2025-02-11	08:10:00	17:03:00	10	0	8	0	7.5	0	0	t	2025-02-11 08:10:19+00	2025-02-11 17:03:57+00	f	0
1343	25	2025-02-11	08:21:00	17:07:00	21	0	7.5	0	7.5	0	0	t	2025-02-11 08:21:04+00	2025-02-11 17:07:04+00	f	0
1328	24	2025-02-11	08:05:00	17:22:00	5	0	8	0	7.5	0	0	t	2025-02-11 08:05:04+00	2025-02-11 17:22:47+00	f	0
1338	12	2025-02-11	08:15:00	18:51:00	15	0	8	1.5	7.5	0	0	t	2025-02-11 08:15:07+00	2025-02-11 18:51:35+00	f	0
1363	27	2025-02-12	08:20:00	17:05:00	20	0	7.5	0	7.5	0	0	t	2025-02-12 08:20:14+00	2025-02-12 17:05:19+00	f	0
1348	424	2025-02-12	07:56:00	17:20:00	0	0	8	0	8	0	0	t	2025-02-12 07:56:14+00	2025-02-12 17:20:37+00	f	0
1358	25	2025-02-12	08:12:00	17:22:00	12	0	8	0	7.5	0	0	t	2025-02-12 08:12:01+00	2025-02-12 17:22:25+00	f	0
1353	20	2025-02-12	08:05:00	17:30:00	5	0	8	0	7.5	0	0	t	2025-02-12 08:05:24+00	2025-02-12 17:30:45+00	f	0
1367	26	2025-02-13	07:59:00	17:05:00	0	0	8	0	8	0	0	t	2025-02-13 07:59:42+00	2025-02-13 17:05:07+00	f	0
1371	20	2025-02-13	08:08:00	17:13:00	8	0	8	0	7.5	0	0	t	2025-02-13 08:08:25+00	2025-02-13 17:13:36+00	f	0
1375	23	2025-02-13	08:10:00	18:58:00	10	0	8	1.5	7.5	0	0	t	2025-02-13 08:10:51+00	2025-02-13 18:58:55+00	f	0
793	6	2025-01-07	08:16:00	17:24:00	16	0	7.5	0	7.5	0	0	t	2025-01-07 08:16:00+00	2025-01-07 17:24:04+00	f	0
784	24	2025-01-07	08:10:00	17:24:00	10	0	8	0	7.5	0	0	t	2025-01-07 08:10:12+00	2025-01-07 17:24:48+00	f	0
804	26	2025-01-08	07:48:00	17:06:00	0	0	8	0	8	0	0	t	2025-01-08 07:48:14+00	2025-01-08 17:06:52+00	f	0
1174	15	2025-02-03	08:02:00	17:08:00	2	0	8	0	7.5	0	0	t	2025-02-03 08:02:53+00	2025-02-03 17:08:05+00	f	0
818	27	2025-01-08	08:17:00	17:33:00	17	0	7.5	0	7.5	0	0	t	2025-01-08 08:17:09+00	2025-01-08 17:33:06+00	f	0
846	8	2025-01-09	08:15:00	17:00:00	15	0	8	0	7.5	0	0	t	2025-01-09 09:32:59+00	2025-01-09 17:00:13+00	f	0
832	3	2025-01-09	08:10:00	17:01:00	10	0	8	0	7.5	0	0	t	2025-01-09 08:10:27+00	2025-01-09 17:01:37+00	f	0
870	23	2025-01-10	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-10 12:54:21+00	2025-01-10 12:54:21+00	f	0
851	10	2025-01-10	08:02:00	17:01:00	2	0	8	0	7.5	0	0	t	2025-01-10 08:02:14+00	2025-01-10 17:01:23+00	f	0
909	9	2025-01-13	08:16:00	17:06:00	16	0	7.5	0	7.5	0	0	t	2025-01-13 08:16:20+00	2025-01-13 17:06:35+00	f	0
1209	9	2025-02-04	08:12:00	16:15:00	12	45	7	0	6.5	0	0	t	2025-02-04 08:12:16+00	2025-02-04 16:15:04+00	f	0
940	29	2025-01-15	08:01:00	17:05:00	1	0	8	0	7.5	0	0	t	2025-01-15 08:01:23+00	2025-01-15 17:05:19+00	f	0
954	10	2025-01-15	08:20:00	17:06:00	20	0	7.5	0	7.5	0	0	t	2025-01-15 08:20:51+00	2025-01-15 17:06:57+00	f	0
966	15	2025-01-16	08:08:00	\N	8	0	0	0	0	0	0	t	2025-01-16 08:08:27+00	2025-01-16 08:08:27+00	f	0
1201	10	2025-02-04	08:06:00	17:01:00	6	0	8	0	7.5	0	0	t	2025-02-04 08:06:38+00	2025-02-04 17:01:17+00	f	0
1192	15	2025-02-04	07:59:00	17:08:00	0	0	8	0	8	0	0	t	2025-02-04 07:59:07+00	2025-02-04 17:08:39+00	f	0
927	8	2025-01-14	08:00:00	19:36:00	0	0	8	2	8	0	0	t	2025-01-14 08:15:42+00	2025-01-16 10:42:33+00	f	0
978	14	2025-01-16	20:09:00	20:09:00	669	0	0	2	-3	0	0	t	2025-01-16 20:09:02+00	2025-01-16 20:09:04+00	f	0
991	14	2025-01-17	08:11:00	19:29:00	11	0	8	2	7.5	0	0	t	2025-01-17 08:11:29+00	2025-01-17 19:29:49+00	f	0
1027	24	2025-01-20	08:04:00	17:47:00	4	0	8	0.5	7.5	0	0	t	2025-01-20 08:04:37+00	2025-01-20 17:47:01+00	f	0
1039	11	2025-01-20	09:12:00	17:59:00	72	0	6.75	0.5	6.5	0	0	t	2025-01-20 09:12:54+00	2025-01-20 17:59:39+00	f	0
1051	5	2025-01-21	08:05:00	17:04:00	5	0	8	0	7.5	0	0	t	2025-01-21 08:05:42+00	2025-01-21 17:04:32+00	f	0
1047	22	2025-01-21	07:59:00	18:08:00	0	0	8	0.5	8	0	0	t	2025-01-21 07:59:52+00	2025-01-21 18:08:03+00	f	0
974	12	2025-01-16	08:23:00	20:07:00	23	0	7.5	2	8	0	0	f	2025-01-16 08:23:54+00	2025-01-22 10:26:24+00	f	0
1072	27	2025-01-22	08:14:00	17:10:00	14	0	8	0	7.5	0	0	t	2025-01-22 08:14:28+00	2025-01-22 17:10:07+00	f	0
1094	10	2025-01-23	08:11:00	17:01:00	11	0	8	0	7.5	0	0	t	2025-01-23 08:11:13+00	2025-01-23 17:01:07+00	f	0
1116	8	2025-01-24	08:15:00	\N	15	0	0	0	0	0	0	t	2025-01-24 09:20:24+00	2025-01-24 09:21:10+00	f	0
1105	20	2025-01-24	08:06:00	17:15:00	6	0	8	0	7.5	0	0	t	2025-01-24 08:06:35+00	2025-01-24 17:15:53+00	f	0
1184	17	2025-02-03	08:17:00	17:01:00	17	0	7.5	0	7.5	0	0	t	2025-02-03 08:17:27+00	2025-02-03 17:01:34+00	f	0
1216	15	2025-02-05	08:06:00	17:14:00	6	0	8	0	7.5	0	0	t	2025-02-05 08:06:54+00	2025-02-05 17:14:39+00	f	0
1224	424	2025-02-05	08:10:00	17:15:00	10	0	8	0	7.5	0	0	t	2025-02-05 08:10:40+00	2025-02-05 17:15:25+00	f	0
1232	11	2025-02-05	08:17:00	18:43:00	17	0	7.5	1	7.5	0	0	t	2025-02-05 08:17:32+00	2025-02-05 18:43:49+00	f	0
1273	27	2025-02-07	08:21:00	12:09:00	21	240	3.5	0	3.5	0	0	t	2025-02-07 08:21:03+00	2025-02-07 12:09:32+00	f	0
1238	26	2025-02-06	07:52:00	17:10:00	0	0	8	0	8	0	0	t	2025-02-06 07:52:18+00	2025-02-06 17:10:18+00	f	0
1246	20	2025-02-06	08:12:00	17:32:00	12	0	8	0	7.5	0	0	t	2025-02-06 08:12:52+00	2025-02-06 17:32:27+00	f	0
1254	23	2025-02-06	08:25:00	18:36:00	25	0	7.5	1	7.5	0	0	t	2025-02-06 08:25:10+00	2025-02-06 18:36:34+00	f	0
1279	19	2025-02-07	15:12:00	15:12:00	372	108	0	0	0	0	0	t	2025-02-07 15:12:19+00	2025-02-07 15:12:23+00	f	0
1259	26	2025-02-07	08:02:00	17:03:00	2	0	8	0	7.5	0	0	t	2025-02-07 08:02:35+00	2025-02-07 17:03:11+00	f	0
1267	13	2025-02-07	08:13:00	17:03:00	13	0	8	0	7.5	0	0	t	2025-02-07 08:13:14+00	2025-02-07 17:03:38+00	f	0
1324	25	2025-02-10	08:21:00	17:07:00	21	0	7.5	0	7.5	0	0	t	2025-02-10 08:21:29+00	2025-02-10 17:07:17+00	f	0
1319	17	2025-02-10	08:14:00	17:08:00	14	0	8	0	7.5	0	0	t	2025-02-10 08:14:53+00	2025-02-10 17:08:09+00	f	0
1314	20	2025-02-10	08:08:00	17:10:00	8	0	8	0	7.5	0	0	t	2025-02-10 08:08:49+00	2025-02-10 17:10:35+00	f	0
1309	424	2025-02-10	07:58:00	17:14:00	0	0	8	0	8	0	0	t	2025-02-10 07:58:32+00	2025-02-10 17:14:53+00	f	0
1334	10	2025-02-11	08:10:00	17:07:00	10	0	8	0	7.5	0	0	t	2025-02-11 08:10:52+00	2025-02-11 17:07:01+00	f	0
1329	18	2025-02-11	08:05:00	17:12:00	5	0	8	0	7.5	0	0	t	2025-02-11 08:05:57+00	2025-02-11 17:12:18+00	f	0
1344	23	2025-02-11	08:36:00	18:51:00	36	0	7.25	1.5	7	0	0	t	2025-02-11 08:36:02+00	2025-02-11 18:51:55+00	f	0
1339	11	2025-02-11	08:15:00	18:14:00	15	0	8	0.5	7.5	0	0	t	2025-02-11 08:15:49+00	2025-02-11 18:14:19+00	f	0
1349	10	2025-02-12	08:01:00	17:01:00	1	0	8	0	7.5	0	0	t	2025-02-12 08:01:12+00	2025-02-12 17:01:50+00	f	0
1354	22	2025-02-12	08:07:00	17:33:00	7	0	8	0	7.5	0	0	t	2025-02-12 08:07:34+00	2025-02-12 17:33:36+00	f	0
1364	12	2025-02-12	09:49:00	18:01:00	109	0	6	0.5	6	0	0	t	2025-02-12 09:49:24+00	2025-02-12 18:01:13+00	f	0
1359	23	2025-02-12	08:12:00	19:15:00	12	0	8	2	7.5	0	0	t	2025-02-12 08:12:38+00	2025-02-12 19:15:41+00	f	0
1372	15	2025-02-13	08:08:00	17:30:00	8	0	8	0	7.5	0	0	t	2025-02-13 08:08:39+00	2025-02-13 17:30:46+00	f	0
794	16	2025-01-07	08:16:00	\N	16	0	0	0	0	0	0	t	2025-01-07 08:16:10+00	2025-01-07 08:16:10+00	f	0
785	4	2025-01-07	08:10:00	17:02:00	10	0	8	0	7.5	0	0	t	2025-01-07 08:10:35+00	2025-01-07 17:02:22+00	f	0
805	29	2025-01-08	07:55:00	17:03:00	0	0	8	0	8	0	0	t	2025-01-08 07:55:55+00	2025-01-08 17:03:17+00	f	0
819	12	2025-01-08	08:17:00	17:48:00	17	0	7.5	0.5	7.5	0	0	t	2025-01-08 08:17:33+00	2025-01-08 17:48:26+00	f	0
765	22	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
766	7	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
767	7	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
768	9	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
489	15	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
490	29	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
491	11	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
492	16	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
493	8	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
494	13	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
495	13	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
496	13	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
497	13	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
498	13	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
734	14	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
735	14	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
736	4	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
737	4	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
738	12	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
739	12	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
740	23	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
741	23	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
742	17	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
743	17	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
744	26	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
745	26	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
746	6	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
747	6	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
499	25	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
500	25	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
501	25	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
502	25	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
503	25	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
509	14	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
510	14	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
511	14	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
512	14	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
513	14	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
514	4	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
515	4	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
516	4	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
833	29	2025-01-09	08:10:00	17:05:00	10	0	8	0	7.5	0	0	t	2025-01-09 08:10:45+00	2025-01-09 17:05:41+00	f	0
852	26	2025-01-10	08:03:00	17:03:00	3	0	8	0	7.5	0	0	t	2025-01-10 08:03:28+00	2025-01-10 17:03:07+00	f	0
865	15	2025-01-10	08:21:00	17:03:00	21	0	7.5	0	7.5	0	0	t	2025-01-10 08:21:52+00	2025-01-10 17:03:48+00	f	0
786	18	2025-01-07	08:10:00	\N	10	0	0	0	0	0	0	t	2025-01-07 08:10:37+00	2025-01-07 08:10:37+00	f	0
871	13	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
853	24	2025-01-10	08:04:00	17:05:00	4	0	8	0	7.5	0	0	t	2025-01-10 08:04:29+00	2025-01-10 17:05:06+00	f	0
873	14	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
874	4	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
795	13	2025-01-07	08:17:00	17:04:00	17	0	7.5	0	7.5	0	0	t	2025-01-07 08:17:42+00	2025-01-07 17:04:43+00	f	0
820	16	2025-01-08	08:18:00	\N	18	0	0	0	0	0	0	t	2025-01-08 08:18:38+00	2025-01-08 08:18:38+00	f	0
806	20	2025-01-08	08:01:00	17:04:00	1	0	8	0	7.5	0	0	t	2025-01-08 08:01:03+00	2025-01-08 17:04:30+00	f	0
834	18	2025-01-09	08:13:00	\N	13	0	0	0	0	0	0	t	2025-01-09 08:13:48+00	2025-01-09 08:13:48+00	f	0
769	9	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
770	15	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
771	15	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
772	29	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
773	29	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
774	11	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
517	4	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
518	4	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
519	12	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
520	12	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
521	12	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
522	12	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
523	12	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
524	23	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
525	23	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
526	23	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
527	23	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
528	23	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
529	17	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
530	17	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
531	17	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
532	17	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
533	17	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
534	26	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
535	26	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
536	26	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
537	26	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
538	26	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
539	6	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
540	6	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
541	6	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
542	6	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
543	6	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
544	27	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
545	27	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
546	27	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
547	27	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
548	27	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
549	10	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
550	10	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
551	10	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
552	10	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
875	12	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
876	23	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
821	13	2025-01-08	08:22:00	17:28:00	22	0	7.5	0	7.5	0	0	t	2025-01-08 08:22:59+00	2025-01-08 17:28:58+00	f	0
807	15	2025-01-08	08:01:00	17:40:00	1	0	8	0	7.5	0	0	t	2025-01-08 08:01:48+00	2025-01-08 17:40:06+00	f	0
553	10	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
554	19	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
555	19	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
556	19	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
557	19	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
558	19	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
559	20	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
560	20	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
561	20	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
562	20	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
563	20	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
564	24	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
565	24	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
566	24	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
567	24	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
568	24	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
569	5	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
570	5	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
571	5	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
572	5	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
573	5	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
574	3	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
575	3	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
576	3	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
577	3	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
578	3	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
579	18	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
580	18	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
581	18	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
582	18	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
583	18	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
584	22	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
585	22	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
586	22	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
587	22	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
588	22	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
589	7	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
590	7	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
591	7	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
592	7	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
593	7	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
594	9	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
595	9	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
596	9	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
597	9	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
598	9	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
599	15	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
600	15	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
601	15	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
602	15	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
835	5	2025-01-09	08:13:00	17:16:00	13	0	8	0	7.5	0	0	t	2025-01-09 08:13:49+00	2025-01-09 17:16:06+00	f	0
854	4	2025-01-10	08:08:00	17:01:00	8	0	8	0	7.5	0	0	t	2025-01-10 08:08:55+00	2025-01-10 17:01:05+00	f	0
877	17	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
822	23	2025-01-08	08:23:00	17:13:00	23	0	7.5	0	7.5	0	0	t	2025-01-08 08:23:38+00	2025-01-08 17:13:45+00	f	0
808	24	2025-01-08	08:05:00	17:36:00	5	0	8	0	7.5	0	0	t	2025-01-08 08:05:47+00	2025-01-08 17:36:11+00	f	0
603	15	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
604	29	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
605	29	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
606	29	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
607	29	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
608	29	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
609	11	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
610	11	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
611	11	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
612	11	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
613	11	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
614	16	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
615	16	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
616	16	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
617	16	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
618	16	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
619	8	2025-01-27	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
620	8	2025-01-28	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
621	8	2025-01-29	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
622	8	2025-01-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
623	8	2025-01-31	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
624	13	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
625	25	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
627	14	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
628	4	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
629	12	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
630	23	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
631	17	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
632	26	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
633	6	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
634	27	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
635	10	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
636	19	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
637	20	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
638	24	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
639	5	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
640	3	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
641	18	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
642	22	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
643	7	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
644	9	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
645	15	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
646	29	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
647	11	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
648	16	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
649	8	2025-04-07	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
650	13	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
651	13	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
652	13	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
836	10	2025-01-09	08:14:00	17:01:00	14	0	8	0	7.5	0	0	t	2025-01-09 08:14:49+00	2025-01-09 17:01:34+00	f	0
855	13	2025-01-10	08:09:00	17:43:00	9	0	8	0	7.5	0	0	t	2025-01-10 08:09:00+00	2025-01-10 17:43:13+00	f	0
878	6	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
823	4	2025-01-08	08:30:00	17:00:00	30	0	7.5	0	7.5	0	0	t	2025-01-08 08:30:13+00	2025-01-08 17:00:40+00	f	0
809	22	2025-01-08	08:06:00	17:33:00	6	0	8	0	7.5	0	0	t	2025-01-08 08:06:12+00	2025-01-08 17:33:19+00	f	0
837	14	2025-01-09	08:15:00	\N	15	0	0	0	0	0	0	t	2025-01-09 08:15:23+00	2025-01-09 08:15:23+00	f	0
653	25	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
654	25	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
655	25	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
659	14	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:12+00	2025-01-06 16:34:12+00	t	1
660	14	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
661	14	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
662	4	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
663	4	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
664	4	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
665	12	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
666	12	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
667	12	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
668	23	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
669	23	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
670	23	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
671	17	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
672	17	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
673	17	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
674	26	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
675	26	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
676	26	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
677	6	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
678	6	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
679	6	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
680	27	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
681	27	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
682	27	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
683	10	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
684	10	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
685	10	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
468	13	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
469	25	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
471	14	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
472	4	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
473	12	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
686	19	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
687	19	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
688	19	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
689	20	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
690	20	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
691	20	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
692	24	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
693	24	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
694	24	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
695	5	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
696	5	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
879	8	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
856	20	2025-01-10	08:10:00	17:10:00	10	0	8	0	7.5	0	0	t	2025-01-10 08:10:21+00	2025-01-10 17:10:37+00	f	0
810	3	2025-01-08	08:06:00	17:01:00	6	0	8	0	7.5	0	0	t	2025-01-08 08:06:36+00	2025-01-08 17:01:24+00	f	0
824	8	2025-01-08	08:48:00	17:03:00	48	0	7	0	7	0	0	t	2025-01-08 08:48:51+00	2025-01-08 17:03:30+00	f	0
697	5	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
698	3	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
699	3	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
700	3	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
701	18	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
702	18	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
703	18	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
704	22	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
705	22	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
706	22	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
707	7	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
708	7	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
709	7	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
710	9	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
711	9	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
712	9	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
838	27	2025-01-09	08:15:00	17:12:00	15	0	8	0	7.5	0	0	t	2025-01-09 08:15:26+00	2025-01-09 17:12:09+00	f	0
857	3	2025-01-10	08:10:00	15:07:00	10	113	5.75	0	5.5	0	0	t	2025-01-10 08:10:45+00	2025-01-10 15:07:46+00	f	0
880	10	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
881	22	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
882	20	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
883	24	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
884	5	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
885	25	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
886	11	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
887	18	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
888	7	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
889	3	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
890	9	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
891	27	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
892	15	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
893	29	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
894	16	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
895	19	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
896	26	2025-01-11	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-11 23:30:01+00	2025-01-11 23:30:01+00	f	0
1084	9	2025-01-06	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-22 10:26:53+00	2025-01-22 10:26:53+00	f	0
929	12	2025-01-14	08:16:00	17:52:00	16	0	7.5	0.5	7.5	0	0	t	2025-01-14 08:16:54+00	2025-01-14 17:52:24+00	f	0
942	26	2025-01-15	08:02:00	17:03:00	2	0	8	0	7.5	0	0	t	2025-01-15 08:02:29+00	2025-01-15 17:03:00+00	f	0
955	17	2025-01-15	08:35:00	17:05:00	35	0	7.25	0	7	0	0	t	2025-01-15 08:35:40+00	2025-01-15 17:05:23+00	f	0
967	4	2025-01-16	08:08:00	17:07:00	8	0	8	0	7.5	0	0	t	2025-01-16 08:08:29+00	2025-01-16 17:07:22+00	f	0
979	9	2025-01-17	07:53:00	17:01:00	0	0	8	0	8	0	0	t	2025-01-17 07:53:49+00	2025-01-17 17:01:00+00	f	0
992	6	2025-01-17	08:13:00	18:11:00	13	0	8	0.5	7.5	0	0	t	2025-01-17 08:13:15+00	2025-01-17 18:11:39+00	f	0
911	7	2025-01-13	08:26:00	18:56:00	26	0	7.5	1.5	8	0	0	f	2025-01-13 08:26:31+00	2025-01-22 10:26:24+00	f	0
1028	23	2025-01-20	08:05:00	17:50:00	5	0	8	0.5	7.5	0	0	t	2025-01-20 08:05:58+00	2025-01-20 17:50:48+00	f	0
1052	4	2025-01-21	08:07:00	17:01:00	7	0	8	0	7.5	0	0	t	2025-01-21 08:07:25+00	2025-01-21 17:01:03+00	f	0
1073	23	2025-01-22	08:15:00	\N	15	0	0	0	0	0	0	t	2025-01-22 08:15:41+00	2025-01-22 08:15:41+00	f	0
1040	5	2025-01-20	09:52:00	17:05:00	112	0	6	0	6	2	0	t	2025-01-20 09:52:55+00	2025-01-22 09:47:09+00	f	0
1062	3	2025-01-22	07:56:00	17:01:00	0	0	8	0	8	0	0	t	2025-01-22 07:56:55+00	2025-01-22 17:01:46+00	f	0
1095	13	2025-01-23	08:12:00	17:02:00	12	0	8	0	7.5	0	0	t	2025-01-23 08:12:55+00	2025-01-23 17:02:39+00	f	0
1106	13	2025-01-24	08:11:00	17:03:00	11	0	8	0	7.5	0	0	t	2025-01-24 08:11:12+00	2025-01-24 17:03:37+00	f	0
1117	11	2025-01-24	09:44:00	17:47:00	104	0	6.25	0.5	6	0	0	t	2025-01-24 09:44:43+00	2025-01-24 17:47:16+00	f	0
811	18	2025-01-08	08:09:00	\N	9	0	0	0	0	0	0	t	2025-01-08 08:09:05+00	2025-01-08 08:09:05+00	f	0
825	11	2025-01-08	10:02:00	17:59:00	122	0	5.75	0.5	5.5	0	0	t	2025-01-08 10:02:49+00	2025-01-08 17:59:08+00	f	0
775	11	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
776	16	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
777	16	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
778	8	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
779	8	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:14+00	2025-01-06 16:34:14+00	t	1
474	23	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
475	17	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
476	26	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
477	6	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
478	27	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
479	10	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
839	23	2025-01-09	08:16:00	17:40:00	16	0	7.5	0	7.5	0	0	t	2025-01-09 08:16:05+00	2025-01-09 17:40:53+00	f	0
1128	9	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1129	25	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1041	7	2025-01-20	09:55:00	18:10:00	115	0	6	0.5	6	2	0	f	2025-01-20 09:55:02+00	2025-01-22 10:26:24+00	f	0
858	9	2025-01-10	08:14:00	16:22:00	14	38	7	0	6.5	2	0	t	2025-01-10 08:14:27+00	2025-01-22 10:26:53+00	f	0
915	19	2025-01-13	16:35:00	16:35:00	455	25	0	0	0	0	0	t	2025-01-13 16:35:20+00	2025-01-13 16:35:22+00	f	0
897	10	2025-01-13	08:01:00	17:02:00	1	0	8	0	7.5	0	0	t	2025-01-13 08:01:59+00	2025-01-13 17:02:36+00	f	0
1085	11	2025-01-22	13:14:00	17:11:00	254	0	3.75	0	4	0	0	t	2025-01-22 13:14:13+00	2025-01-22 17:11:02+00	f	0
912	8	2025-01-13	08:09:00	17:46:00	9	0	8	0.5	7.5	0	0	t	2025-01-13 08:39:18+00	2025-01-13 17:46:21+00	f	0
910	6	2025-01-13	08:18:00	18:47:00	18	0	7.5	1.5	7.5	0	0	t	2025-01-13 08:18:35+00	2025-01-13 18:47:00+00	f	0
930	27	2025-01-14	08:18:00	17:06:00	18	0	7.5	0	7.5	0	0	t	2025-01-14 08:18:05+00	2025-01-14 17:06:53+00	f	0
943	20	2025-01-15	08:04:00	17:01:00	4	0	8	0	7.5	0	0	t	2025-01-15 08:04:39+00	2025-01-15 17:01:11+00	f	0
956	12	2025-01-15	08:38:00	18:02:00	38	0	7.25	0.5	7	0	0	t	2025-01-15 08:38:02+00	2025-01-15 18:02:46+00	f	0
968	5	2025-01-16	08:08:00	17:14:00	8	0	8	0	7.5	0	0	t	2025-01-16 08:08:43+00	2025-01-16 17:14:27+00	f	0
993	10	2025-01-17	08:13:00	17:01:00	13	0	8	0	7.5	0	0	t	2025-01-17 08:13:29+00	2025-01-17 17:01:04+00	f	0
980	15	2025-01-17	07:54:00	17:20:00	0	0	8	0	8	0	0	t	2025-01-17 07:54:24+00	2025-01-17 17:20:08+00	f	0
1029	29	2025-01-20	08:07:00	17:05:00	7	0	8	0	7.5	0	0	t	2025-01-20 08:07:02+00	2025-01-20 17:05:05+00	f	0
1130	5	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1053	29	2025-01-21	08:10:00	12:00:00	10	240	3.75	0	3.5	0	0	t	2025-01-21 08:10:06+00	2025-01-21 12:00:01+00	f	0
1063	4	2025-01-22	08:04:00	\N	4	0	0	0	0	0	0	t	2025-01-22 08:04:06+00	2025-01-22 08:04:06+00	f	0
1074	25	2025-01-22	08:18:00	\N	18	0	0	0	0	0	0	t	2025-01-22 08:18:22+00	2025-01-22 08:18:22+00	f	0
1096	9	2025-01-23	08:14:00	17:00:00	14	0	8	0	7.5	0	0	t	2025-01-23 08:14:50+00	2025-01-23 17:00:42+00	f	0
1107	24	2025-01-24	08:11:00	12:20:00	11	240	3.75	0	3.5	0	0	t	2025-01-24 08:11:24+00	2025-01-24 12:20:20+00	f	0
1119	27	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1120	4	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1121	12	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1122	23	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1123	17	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1124	6	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1125	24	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1126	10	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1127	8	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1131	3	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1132	11	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1133	18	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1134	29	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1135	16	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1136	19	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1137	26	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1138	13	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
787	7	2025-01-07	08:10:00	17:09:00	10	0	8	0	7.5	0	0	t	2025-01-07 08:10:53+00	2025-01-07 17:09:24+00	f	0
796	12	2025-01-07	08:19:00	17:46:00	19	0	7.5	0.5	7.5	0	0	t	2025-01-07 08:19:25+00	2025-01-07 17:46:23+00	f	0
812	5	2025-01-08	08:09:00	17:19:00	9	0	8	0	7.5	0	0	t	2025-01-08 08:09:19+00	2025-01-08 17:19:36+00	f	0
826	14	2025-01-08	17:57:00	17:57:00	537	0	0	0.5	-0.5	0	0	t	2025-01-08 17:57:39+00	2025-01-08 17:57:42+00	f	0
480	19	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
481	20	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
482	24	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
483	5	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
484	3	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
485	18	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
486	22	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
487	7	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
488	9	2025-01-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:11+00	2025-01-06 16:34:11+00	t	1
727	8	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
728	13	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
729	13	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
730	25	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
731	25	2025-09-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
840	6	2025-01-09	08:16:00	17:28:00	16	0	7.5	0	7.5	0	0	t	2025-01-09 08:16:59+00	2025-01-09 17:28:52+00	f	0
859	5	2025-01-10	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-01-10 08:15:37+00	2025-01-10 17:01:31+00	f	0
898	15	2025-01-13	08:04:00	17:03:00	4	0	8	0	7.5	0	0	t	2025-01-13 08:04:44+00	2025-01-13 17:03:10+00	f	0
904	29	2025-01-13	08:12:00	17:04:00	12	0	8	0	7.5	0	0	t	2025-01-13 08:12:02+00	2025-01-13 17:04:14+00	f	0
913	11	2025-01-13	10:04:00	18:31:00	124	0	5.75	1	5.5	0	0	t	2025-01-13 10:04:27+00	2025-01-13 18:31:09+00	f	0
931	4	2025-01-14	08:22:00	17:01:00	22	0	7.5	0	7.5	0	0	t	2025-01-14 08:22:14+00	2025-01-14 17:01:04+00	f	0
916	22	2025-01-14	07:53:00	17:07:00	0	0	8	0	8	0	0	t	2025-01-14 07:53:27+00	2025-01-14 17:07:15+00	f	0
944	15	2025-01-15	08:05:00	17:01:00	5	0	8	0	7.5	0	0	t	2025-01-15 08:05:47+00	2025-01-15 17:01:00+00	f	0
941	3	2025-01-15	08:01:00	17:19:00	1	0	8	0	7.5	0	0	t	2025-01-15 08:01:23+00	2025-01-15 17:19:09+00	f	0
969	29	2025-01-16	08:08:00	17:04:00	8	0	8	0	7.5	0	0	t	2025-01-16 08:08:46+00	2025-01-16 17:04:18+00	f	0
981	20	2025-01-17	07:55:00	17:19:00	0	0	8	0	8	0	0	t	2025-01-17 07:55:22+00	2025-01-17 17:19:42+00	f	0
994	12	2025-01-17	08:17:00	17:57:00	17	0	7.5	0.5	7.5	0	0	t	2025-01-17 08:17:17+00	2025-01-17 17:57:30+00	f	0
1030	3	2025-01-20	08:13:00	17:02:00	13	0	8	0	7.5	0	0	t	2025-01-20 08:13:23+00	2025-01-20 17:02:15+00	f	0
1042	25	2025-01-20	17:01:00	17:02:00	481	0	0	0	0	0	0	t	2025-01-20 17:01:35+00	2025-01-20 17:02:44+00	f	0
1054	13	2025-01-21	08:14:00	17:01:00	14	0	8	0	7.5	0	0	t	2025-01-21 08:14:18+00	2025-01-21 17:01:58+00	f	0
1185	16	2025-02-03	08:17:00	17:19:00	17	0	7.5	0	7.5	0	0	t	2025-02-03 08:17:46+00	2025-02-03 17:19:50+00	f	0
1064	13	2025-01-22	08:07:00	12:22:00	7	240	3.75	0	3.5	4	0	t	2025-01-22 08:07:59+00	2025-01-22 12:22:00+00	f	0
1086	19	2025-01-22	15:32:00	\N	392	0	0	0	0	0	0	t	2025-01-22 15:32:41+00	2025-01-22 15:32:41+00	f	0
1075	10	2025-01-22	08:20:00	17:02:00	20	0	7.5	0	7.5	0	0	t	2025-01-22 08:20:15+00	2025-01-22 17:02:04+00	f	0
1097	12	2025-01-23	08:16:00	18:23:00	16	0	7.5	1	7.5	0	0	t	2025-01-23 08:16:33+00	2025-01-23 18:23:08+00	f	0
1108	22	2025-01-24	08:12:00	15:07:00	12	113	5.75	0	5.5	0	0	t	2025-01-24 08:12:04+00	2025-01-24 15:07:02+00	f	0
1139	7	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1140	20	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1141	22	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1142	15	2025-01-25	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-25 23:30:02+00	2025-01-25 23:30:02+00	f	0
1176	18	2025-02-03	08:09:00	17:51:00	9	0	8	0.5	7.5	0	0	t	2025-02-03 08:09:15+00	2025-02-03 17:51:08+00	f	0
1193	20	2025-02-04	08:00:00	17:03:00	0	0	8	0	8	0	0	t	2025-02-04 08:00:44+00	2025-02-04 17:03:06+00	f	0
1210	25	2025-02-04	08:14:00	17:06:00	14	0	8	0	7.5	0	0	t	2025-02-04 08:14:34+00	2025-02-04 17:06:09+00	f	0
1202	18	2025-02-04	08:06:00	17:16:00	6	0	8	0	7.5	0	0	t	2025-02-04 08:06:40+00	2025-02-04 17:16:37+00	f	0
1233	6	2025-02-05	08:18:00	17:18:00	18	0	7.5	0	7.5	0	0	t	2025-02-05 08:18:54+00	2025-02-05 17:18:33+00	f	0
1217	18	2025-02-05	08:07:00	18:34:00	7	0	8	1	7.5	0	0	t	2025-02-05 08:07:04+00	2025-02-05 18:34:38+00	f	0
1225	23	2025-02-05	08:11:00	18:08:00	11	0	8	0.5	7.5	0	0	t	2025-02-05 08:11:29+00	2025-02-05 18:08:55+00	f	0
1239	4	2025-02-06	08:03:00	17:01:00	3	0	8	0	7.5	0	0	t	2025-02-06 08:03:16+00	2025-02-06 17:01:57+00	f	0
1255	11	2025-02-06	08:26:00	18:42:00	26	0	7.5	1	7.5	0	0	t	2025-02-06 08:26:06+00	2025-02-06 18:42:32+00	f	0
860	6	2025-01-10	08:16:00	18:47:00	16	0	7.5	1.5	7.5	0	0	t	2025-01-10 08:16:38+00	2025-01-10 18:47:20+00	f	0
1156	3	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
914	23	2025-01-13	13:01:00	\N	241	0	0	0	0	0	0	t	2025-01-13 13:01:32+00	2025-01-13 13:01:32+00	f	0
932	11	2025-01-14	08:26:00	\N	26	0	0	0	0	0	0	t	2025-01-14 08:26:08+00	2025-01-14 08:26:08+00	f	0
917	20	2025-01-14	07:54:00	17:01:00	0	0	8	0	8	0	0	t	2025-01-14 07:54:16+00	2025-01-14 17:01:51+00	f	0
1157	11	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
957	14	2025-01-15	18:46:00	18:46:00	586	0	0	1.5	-1.5	0	0	t	2025-01-15 18:46:38+00	2025-01-15 18:46:40+00	f	0
970	13	2025-01-16	08:18:00	17:04:00	18	0	7.5	0	7.5	0	0	t	2025-01-16 08:18:09+00	2025-01-16 17:04:07+00	f	0
1158	18	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1159	29	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
995	8	2025-01-17	08:19:00	17:02:00	19	0	7.5	0	7.5	0	0	t	2025-01-17 08:19:15+00	2025-01-17 17:02:51+00	f	0
982	24	2025-01-17	07:56:00	17:10:00	0	0	8	0	8	0	0	t	2025-01-17 07:56:15+00	2025-01-17 17:10:02+00	f	0
1031	4	2025-01-20	08:13:00	17:01:00	13	0	8	0	7.5	0	0	t	2025-01-20 08:13:29+00	2025-01-20 17:01:25+00	f	0
1043	15	2025-01-20	17:28:00	17:28:00	508	0	0	0	0	0	0	t	2025-01-20 17:28:41+00	2025-01-20 17:28:43+00	f	0
1055	7	2025-01-21	08:14:00	\N	14	0	0	0	0	0	0	t	2025-01-21 08:14:43+00	2025-01-21 08:14:43+00	f	0
945	13	2025-01-15	08:09:00	12:44:00	9	240	3.75	0	3.5	4	0	t	2025-01-15 08:09:18+00	2025-01-22 10:25:14+00	f	0
899	24	2025-01-13	08:04:00	12:01:00	4	240	3.75	0	3.5	4	0	t	2025-01-13 08:04:47+00	2025-01-22 10:26:53+00	f	0
1076	26	2025-01-22	08:39:00	17:09:00	39	0	7.25	0	7	0	0	t	2025-01-22 08:39:54+00	2025-01-22 17:09:09+00	f	0
1065	24	2025-01-22	08:08:00	18:09:00	8	0	8	0.5	7.5	0	0	t	2025-01-22 08:08:07+00	2025-01-22 18:09:30+00	f	0
1098	11	2025-01-23	08:28:00	17:10:00	28	0	7.5	0	7.5	0	0	t	2025-01-23 08:28:31+00	2025-01-23 17:10:52+00	f	0
1087	22	2025-01-23	07:52:00	17:21:00	0	0	8	0	8	0	0	t	2025-01-23 07:52:30+00	2025-01-23 17:21:09+00	f	0
1109	29	2025-01-24	08:15:00	16:00:00	15	60	6.75	0	6.5	0	0	t	2025-01-24 08:15:40+00	2025-01-24 16:00:46+00	f	0
1144	27	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1145	4	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1146	12	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1147	23	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1148	17	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1149	6	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1150	24	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1151	10	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1152	8	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1153	9	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1154	25	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1155	5	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1160	16	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1161	19	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1162	26	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1163	13	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1164	7	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1165	20	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1166	22	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1167	15	2025-02-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-01 23:30:01+00	2025-02-01 23:30:01+00	f	0
1186	6	2025-02-03	08:18:00	17:12:00	18	0	7.5	0	7.5	0	0	t	2025-02-03 08:18:05+00	2025-02-03 17:12:36+00	f	0
1177	12	2025-02-03	08:09:00	17:43:00	9	0	8	0	7.5	0	0	t	2025-02-03 08:09:51+00	2025-02-03 17:43:18+00	f	0
1194	7	2025-02-04	08:01:00	17:02:00	1	0	8	0	7.5	0	0	t	2025-02-04 08:01:13+00	2025-02-04 17:02:45+00	f	0
1203	13	2025-02-04	08:07:00	17:05:00	7	0	8	0	7.5	0	0	t	2025-02-04 08:07:16+00	2025-02-04 17:05:10+00	f	0
1211	12	2025-02-04	08:16:00	18:06:00	16	0	7.5	0.5	7.5	0	0	t	2025-02-04 08:16:16+00	2025-02-04 18:06:51+00	f	0
1218	3	2025-02-05	08:08:00	17:01:00	8	0	8	0	7.5	0	0	t	2025-02-05 08:08:13+00	2025-02-05 17:01:22+00	f	0
1234	7	2025-02-05	08:19:00	17:03:00	19	0	7.5	0	7.5	0	0	t	2025-02-05 08:19:40+00	2025-02-05 17:03:48+00	f	0
1226	16	2025-02-05	08:12:00	17:54:00	12	0	8	0.5	7.5	0	0	t	2025-02-05 08:12:09+00	2025-02-05 17:54:27+00	f	0
1256	3	2025-02-06	08:31:00	17:00:00	31	0	7.25	0	7	0	0	t	2025-02-06 08:31:41+00	2025-02-06 17:00:30+00	f	0
1240	9	2025-02-06	08:10:00	17:01:00	10	0	8	0	7.5	0	0	t	2025-02-06 08:10:25+00	2025-02-06 17:01:37+00	f	0
1248	15	2025-02-06	08:13:00	17:47:00	13	0	8	0.5	7.5	0	0	t	2025-02-06 08:13:14+00	2025-02-06 17:47:54+00	f	0
861	29	2025-01-10	08:16:00	17:03:00	16	0	7.5	0	7.5	0	0	t	2025-01-10 08:16:38+00	2025-01-10 17:03:47+00	f	0
900	26	2025-01-13	08:05:00	17:02:00	5	0	8	0	7.5	0	0	t	2025-01-13 08:05:05+00	2025-01-13 17:02:24+00	f	0
933	3	2025-01-14	08:55:00	17:00:00	55	0	7	0	7	0	0	t	2025-01-14 08:55:06+00	2025-01-14 17:00:55+00	f	0
918	29	2025-01-14	07:58:00	17:07:00	0	0	8	0	8	0	0	t	2025-01-14 07:58:42+00	2025-01-14 17:07:32+00	f	0
946	5	2025-01-15	08:10:00	17:03:00	10	0	8	0	7.5	0	0	t	2025-01-15 08:10:39+00	2025-01-15 17:03:02+00	f	0
958	26	2025-01-16	07:50:00	17:11:00	0	0	8	0	8	0	0	t	2025-01-16 07:50:19+00	2025-01-16 17:11:42+00	f	0
971	6	2025-01-16	08:18:00	17:20:00	18	0	7.5	0	7.5	0	0	t	2025-01-16 08:18:25+00	2025-01-16 17:20:04+00	f	0
983	4	2025-01-17	07:56:00	17:13:00	0	0	8	0	8	0	0	t	2025-01-17 07:56:24+00	2025-01-17 17:13:26+00	f	0
996	7	2025-01-17	08:29:00	18:07:00	29	0	7.5	0.5	7.5	0	0	t	2025-01-17 08:29:39+00	2025-01-17 18:07:26+00	f	0
1032	6	2025-01-20	08:14:00	17:34:00	14	0	8	0	7.5	0	0	t	2025-01-20 08:14:41+00	2025-01-20 17:34:15+00	f	0
1044	10	2025-01-21	07:53:00	17:04:00	0	0	8	0	8	0	0	t	2025-01-21 07:53:38+00	2025-01-21 17:04:23+00	f	0
1056	6	2025-01-21	08:15:00	17:21:00	15	0	8	0	7.5	0	0	t	2025-01-21 08:15:19+00	2025-01-21 17:21:03+00	f	0
1066	20	2025-01-22	08:08:00	17:08:00	8	0	8	0	7.5	0	0	t	2025-01-22 08:08:14+00	2025-01-22 17:08:40+00	f	0
1077	12	2025-01-22	08:41:00	18:24:00	41	0	7.25	1	7	0	0	t	2025-01-22 08:41:55+00	2025-01-22 18:24:09+00	f	0
1099	27	2025-01-23	08:29:00	17:01:00	29	0	7.5	0	7.5	0	0	t	2025-01-23 08:29:27+00	2025-01-23 17:01:55+00	f	0
1088	24	2025-01-23	07:56:00	18:04:00	0	0	8	0.5	8	0	0	t	2025-01-23 07:56:32+00	2025-01-23 18:04:03+00	f	0
1110	6	2025-01-24	08:16:00	19:01:00	16	0	7.5	1.5	7.5	0	0	t	2025-01-24 08:16:58+00	2025-01-24 19:01:16+00	f	0
1187	8	2025-02-03	08:15:00	\N	15	0	0	0	0	0	0	t	2025-02-03 08:21:51+00	2025-02-03 08:34:17+00	f	0
1168	3	2025-02-03	07:52:00	17:02:00	0	0	8	0	8	0	0	t	2025-02-03 07:52:05+00	2025-02-03 17:02:54+00	f	0
1178	9	2025-02-03	08:11:00	17:03:00	11	0	8	0	7.5	0	0	t	2025-02-03 08:11:43+00	2025-02-03 17:03:12+00	f	0
1195	26	2025-02-04	08:02:00	17:02:00	2	0	8	0	7.5	0	0	t	2025-02-04 08:02:46+00	2025-02-04 17:02:04+00	f	0
1227	5	2025-02-05	08:12:00	17:05:00	12	0	8	0	7.5	0	0	t	2025-02-05 08:12:35+00	2025-02-05 17:05:33+00	f	0
1204	23	2025-02-04	08:07:00	17:38:00	7	0	8	0	7.5	0	0	t	2025-02-04 08:07:47+00	2025-02-04 17:38:01+00	f	0
1212	11	2025-02-04	08:17:00	18:30:00	17	0	7.5	1	7.5	0	0	t	2025-02-04 08:17:13+00	2025-02-04 18:30:59+00	f	0
1219	19	2025-02-05	08:08:00	17:06:00	8	0	8	0	7.5	0	0	t	2025-02-05 08:08:31+00	2025-02-05 17:06:54+00	f	0
1235	12	2025-02-05	08:24:00	17:18:00	24	0	7.5	0	7.5	0	0	t	2025-02-05 08:24:39+00	2025-02-05 17:18:32+00	f	0
1257	5	2025-02-06	09:56:00	17:08:00	116	0	6	0	6	0	0	t	2025-02-06 09:56:25+00	2025-02-06 17:08:33+00	f	0
1241	22	2025-02-06	08:10:00	17:39:00	10	0	8	0	7.5	0	0	t	2025-02-06 08:10:44+00	2025-02-06 17:39:42+00	f	0
1249	12	2025-02-06	08:14:00	18:10:00	14	0	8	0.5	7.5	0	0	t	2025-02-06 08:14:43+00	2025-02-06 18:10:23+00	f	0
1262	24	2025-02-07	08:06:00	\N	6	0	0	0	0	0	0	t	2025-02-07 08:06:56+00	2025-02-07 08:06:56+00	f	0
1268	5	2025-02-07	08:13:00	17:17:00	13	0	8	0	7.5	0	0	t	2025-02-07 08:13:18+00	2025-02-07 17:17:51+00	f	0
1274	25	2025-02-07	08:23:00	17:23:00	23	0	7.5	0	7.5	0	0	t	2025-02-07 08:23:57+00	2025-02-07 17:23:22+00	f	0
1260	424	2025-02-07	08:03:00	17:40:00	3	0	8	0	7.5	0	0	t	2025-02-07 08:03:25+00	2025-02-07 17:40:39+00	f	0
1310	10	2025-02-10	08:03:00	17:01:00	3	0	8	0	7.5	0	0	t	2025-02-10 08:03:10+00	2025-02-10 17:01:40+00	f	0
1325	3	2025-02-10	08:24:00	17:01:00	24	0	7.5	0	7.5	0	0	t	2025-02-10 08:24:23+00	2025-02-10 17:01:41+00	f	0
1315	22	2025-02-10	08:09:00	17:39:00	9	0	8	0	7.5	0	0	t	2025-02-10 08:09:23+00	2025-02-10 17:39:10+00	f	0
1320	12	2025-02-10	08:15:00	18:16:00	15	0	8	1	7.5	0	0	t	2025-02-10 08:15:59+00	2025-02-10 18:16:17+00	f	0
1330	4	2025-02-11	08:06:00	17:01:00	6	0	8	0	7.5	0	0	t	2025-02-11 08:06:21+00	2025-02-11 17:01:06+00	f	0
1345	15	2025-02-11	11:16:00	17:07:00	196	0	4.5	0	4.5	0	0	t	2025-02-11 11:16:03+00	2025-02-11 17:07:56+00	f	0
1335	20	2025-02-11	08:11:00	17:09:00	11	0	8	0	7.5	0	0	t	2025-02-11 08:11:35+00	2025-02-11 17:09:10+00	f	0
1340	13	2025-02-11	08:16:00	17:17:00	16	0	7.5	0	7.5	0	0	t	2025-02-11 08:16:06+00	2025-02-11 17:17:35+00	f	0
1350	4	2025-02-12	08:01:00	\N	1	0	0	0	0	0	0	t	2025-02-12 08:01:16+00	2025-02-12 08:01:16+00	f	0
1360	9	2025-02-12	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-02-12 08:15:23+00	2025-02-12 17:01:57+00	f	0
1365	5	2025-02-12	09:57:00	17:14:00	117	0	6	0	6	0	0	t	2025-02-12 09:57:31+00	2025-02-12 17:14:14+00	f	0
1355	13	2025-02-12	08:09:00	17:30:00	9	0	8	0	7.5	0	0	t	2025-02-12 08:09:54+00	2025-02-12 17:30:15+00	f	0
1376	4	2025-02-13	08:11:00	15:25:00	11	95	6	0	5.5	0	0	t	2025-02-13 08:11:22+00	2025-02-13 15:25:05+00	f	0
1381	9	2025-02-13	08:13:00	16:30:00	13	30	7.25	0	7	0	0	t	2025-02-13 08:13:41+00	2025-02-13 16:30:03+00	f	0
1366	10	2025-02-13	07:54:00	17:03:00	0	0	8	0	8	0	0	t	2025-02-13 07:54:47+00	2025-02-13 17:03:15+00	f	0
1382	16	2025-02-13	08:13:00	17:10:00	13	0	8	0	7.5	0	0	t	2025-02-13 08:13:46+00	2025-02-13 17:10:48+00	f	0
1369	18	2025-02-13	08:07:00	17:43:00	7	0	8	0	7.5	0	0	t	2025-02-13 08:07:58+00	2025-02-13 17:43:44+00	f	0
1386	11	2025-02-13	08:18:00	18:40:00	18	0	7.5	1	7.5	0	0	t	2025-02-13 08:18:14+00	2025-02-13 18:40:08+00	f	0
1384	12	2025-02-13	08:14:00	20:07:00	14	0	8	2	7.5	0	0	t	2025-02-13 08:14:09+00	2025-02-13 20:07:27+00	f	0
1220	4	2025-02-05	08:08:00	17:01:00	8	0	8	0	7.5	0	0	t	2025-02-05 08:08:38+00	2025-02-05 17:01:13+00	f	0
862	8	2025-01-10	08:15:00	17:03:00	15	0	8	0	7.5	0	0	t	2025-01-10 08:16:48+00	2025-01-10 17:03:33+00	f	0
901	20	2025-01-13	08:07:00	17:14:00	7	0	8	0	7.5	0	0	t	2025-01-13 08:07:19+00	2025-01-13 17:14:20+00	f	0
919	26	2025-01-14	08:01:00	17:03:00	1	0	8	0	7.5	0	0	t	2025-01-14 08:01:33+00	2025-01-14 17:03:47+00	f	0
934	23	2025-01-14	09:04:00	17:28:00	64	0	6.75	0	6.5	0	0	t	2025-01-14 09:04:04+00	2025-01-14 17:28:38+00	f	0
947	19	2025-01-15	08:12:00	\N	12	0	0	0	0	0	0	t	2025-01-15 08:12:34+00	2025-01-15 08:12:34+00	f	0
1236	13	2025-02-05	09:03:00	17:08:00	63	0	6.75	0	6.5	0	0	t	2025-02-05 09:03:41+00	2025-02-05 17:08:31+00	f	0
959	3	2025-01-16	07:57:00	17:03:00	0	0	8	0	8	0	0	t	2025-01-16 07:57:01+00	2025-01-16 17:03:45+00	f	0
984	26	2025-01-17	07:56:00	17:02:00	0	0	8	0	8	0	0	t	2025-01-17 07:56:30+00	2025-01-17 17:02:07+00	f	0
997	11	2025-01-17	10:31:00	18:36:00	151	0	5.25	1	5	0	0	t	2025-01-17 10:31:37+00	2025-01-17 18:36:22+00	f	0
1033	13	2025-01-20	08:14:00	17:25:00	14	0	8	0	7.5	0	0	t	2025-01-20 08:14:49+00	2025-01-20 17:25:56+00	f	0
1057	9	2025-01-21	08:15:00	17:01:00	15	0	8	0	7.5	0	0	t	2025-01-21 08:15:20+00	2025-01-21 17:01:30+00	f	0
1045	24	2025-01-21	07:56:00	17:17:00	0	0	8	0	8	0	0	t	2025-01-21 07:56:39+00	2025-01-21 17:17:32+00	f	0
972	9	2025-01-16	08:19:00	15:01:00	19	119	5.5	0	5.5	2	0	t	2025-01-16 08:19:05+00	2025-01-22 10:26:53+00	f	0
1067	22	2025-01-22	08:08:00	17:50:00	8	0	8	0.5	7.5	0	0	t	2025-01-22 08:08:34+00	2025-01-22 17:50:01+00	f	0
1078	6	2025-01-22	08:49:00	18:46:00	49	0	7	1.5	7	0	0	t	2025-01-22 08:49:07+00	2025-01-22 18:46:25+00	f	0
1089	4	2025-01-23	08:01:00	\N	1	0	0	0	0	0	0	t	2025-01-23 08:01:07+00	2025-01-23 08:01:07+00	f	0
1100	6	2025-01-23	08:32:00	19:35:00	32	0	7.25	2	7	0	0	t	2025-01-23 08:32:37+00	2025-01-23 19:35:28+00	f	0
1111	9	2025-01-24	08:18:00	15:05:00	18	115	5.75	0	5.5	0	0	t	2025-01-24 08:18:24+00	2025-01-24 15:05:25+00	f	0
1169	10	2025-02-03	07:57:00	17:02:00	0	0	8	0	8	0	0	t	2025-02-03 07:57:06+00	2025-02-03 17:02:11+00	f	0
1179	25	2025-02-03	08:11:00	17:14:00	11	0	8	0	7.5	0	0	t	2025-02-03 08:11:58+00	2025-02-03 17:14:27+00	f	0
1188	27	2025-02-03	08:22:00	17:45:00	22	0	7.5	0.5	7.5	0	0	t	2025-02-03 08:22:01+00	2025-02-03 17:45:08+00	f	0
1213	6	2025-02-04	08:41:00	17:07:00	41	0	7.25	0	7	0	0	t	2025-02-04 08:41:22+00	2025-02-04 17:07:17+00	f	0
1205	19	2025-02-04	08:07:00	17:10:00	7	0	8	0	7.5	0	0	t	2025-02-04 08:07:55+00	2025-02-04 17:10:28+00	f	0
1196	424	2025-02-04	08:02:00	17:20:00	2	0	8	0	7.5	0	0	t	2025-02-04 08:02:55+00	2025-02-04 17:20:21+00	f	0
1228	22	2025-02-05	08:13:00	17:39:00	13	0	8	0	7.5	0	0	t	2025-02-05 08:13:06+00	2025-02-05 17:39:43+00	f	0
1242	10	2025-02-06	08:11:00	\N	11	0	0	0	0	0	0	t	2025-02-06 08:11:16+00	2025-02-06 08:11:16+00	f	0
1250	27	2025-02-06	08:15:00	17:05:00	15	0	8	0	7.5	0	0	t	2025-02-06 08:15:20+00	2025-02-06 17:05:46+00	f	0
1258	7	2025-02-06	09:58:00	17:26:00	118	0	6	0	6	0	0	t	2025-02-06 09:58:07+00	2025-02-06 17:26:27+00	f	0
1263	18	2025-02-07	08:08:00	18:07:00	8	0	8	0.5	7.5	0	0	t	2025-02-07 08:08:18+00	2025-02-07 18:07:17+00	f	0
1275	11	2025-02-07	08:30:00	18:16:00	30	0	7.5	1	7.5	0	0	t	2025-02-07 08:30:59+00	2025-02-07 18:16:34+00	f	0
1269	6	2025-02-07	08:13:00	19:50:00	13	0	8	2	7.5	0	0	t	2025-02-07 08:13:19+00	2025-02-07 19:50:02+00	f	0
1261	23	2025-02-07	08:06:00	19:53:00	6	0	8	2	7.5	0	0	t	2025-02-07 08:06:35+00	2025-02-07 19:53:08+00	f	0
1321	29	2025-02-10	08:16:00	17:06:00	16	0	7.5	0	7.5	0	0	t	2025-02-10 08:16:32+00	2025-02-10 17:06:53+00	f	0
1311	24	2025-02-10	08:06:00	17:34:00	6	0	8	0	7.5	0	0	t	2025-02-10 08:06:34+00	2025-02-10 17:34:49+00	f	0
1326	11	2025-02-10	08:26:00	18:11:00	26	0	7.5	0.5	7.5	0	0	t	2025-02-10 08:26:05+00	2025-02-10 18:11:22+00	f	0
1316	23	2025-02-10	08:09:00	18:13:00	9	0	8	0.5	7.5	0	0	t	2025-02-10 08:09:49+00	2025-02-10 18:13:43+00	f	0
1341	26	2025-02-11	08:19:00	17:02:00	19	0	7.5	0	7.5	0	0	t	2025-02-11 08:19:43+00	2025-02-11 17:02:35+00	f	0
1331	424	2025-02-11	08:07:00	17:07:00	7	0	8	0	7.5	0	0	t	2025-02-11 08:07:25+00	2025-02-11 17:07:05+00	f	0
1336	6	2025-02-11	08:12:00	17:20:00	12	0	8	0	7.5	0	0	t	2025-02-11 08:12:10+00	2025-02-11 17:20:54+00	f	0
1346	5	2025-02-11	12:44:00	17:22:00	240	0	4	0	4.5	0	0	t	2025-02-11 12:44:45+00	2025-02-11 17:22:36+00	f	0
1352	24	2025-02-12	08:04:00	17:03:00	4	0	8	0	7.5	0	0	t	2025-02-12 08:04:21+00	2025-02-12 17:03:09+00	f	0
1351	3	2025-02-12	08:01:00	17:10:00	1	0	8	0	7.5	0	0	t	2025-02-12 08:01:43+00	2025-02-12 17:10:29+00	f	0
1356	26	2025-02-12	08:10:00	17:14:00	10	0	8	0	7.5	0	0	t	2025-02-12 08:10:01+00	2025-02-12 17:14:24+00	f	0
1361	6	2025-02-12	08:16:00	17:20:00	16	0	7.5	0	7.5	0	0	t	2025-02-12 08:16:20+00	2025-02-12 17:20:39+00	f	0
1385	29	2025-02-13	08:14:00	17:01:00	14	0	8	0	7.5	0	0	t	2025-02-13 08:14:11+00	2025-02-13 17:01:20+00	f	0
1387	3	2025-02-13	08:51:00	17:01:00	51	0	7	0	7	0	0	t	2025-02-13 08:51:23+00	2025-02-13 17:01:20+00	f	0
1378	27	2025-02-13	08:12:00	17:01:00	12	0	8	0	7.5	0	0	t	2025-02-13 08:12:25+00	2025-02-13 17:01:31+00	f	0
1374	5	2025-02-13	08:09:00	17:03:00	9	0	8	0	7.5	0	0	t	2025-02-13 08:09:57+00	2025-02-13 17:03:06+00	f	0
1379	17	2025-02-13	08:13:00	17:05:00	13	0	8	0	7.5	0	0	t	2025-02-13 08:13:25+00	2025-02-13 17:05:57+00	f	0
1383	6	2025-02-13	08:13:00	17:14:00	13	0	8	0	7.5	0	0	t	2025-02-13 08:13:59+00	2025-02-13 17:14:59+00	f	0
1370	13	2025-02-13	08:08:00	17:27:00	8	0	8	0	7.5	0	0	t	2025-02-13 08:08:06+00	2025-02-13 17:27:37+00	f	0
863	19	2025-01-10	08:16:00	17:03:00	16	0	7.5	0	7.5	0	0	t	2025-01-10 08:16:49+00	2025-01-10 17:03:44+00	f	0
902	3	2025-01-13	08:10:00	17:11:00	10	0	8	0	7.5	0	0	t	2025-01-13 08:10:47+00	2025-01-13 17:11:46+00	f	0
1237	992	2025-02-05	11:46:00	11:46:00	226	254	0	0	-0.5	0	0	t	2025-02-05 11:46:38+00	2025-02-05 11:46:50+00	f	0
920	17	2025-01-14	08:04:00	17:07:00	4	0	8	0	7.5	0	0	t	2025-01-14 08:04:54+00	2025-01-14 17:07:25+00	f	0
935	15	2025-01-14	11:22:00	17:11:00	202	0	4.5	0	4.5	0	0	t	2025-01-14 11:22:24+00	2025-01-14 17:11:21+00	f	0
948	8	2025-01-15	08:14:00	17:08:00	14	0	8	0	7.5	0	0	t	2025-01-15 08:14:44+00	2025-01-15 17:08:54+00	f	0
973	11	2025-01-16	08:21:00	17:01:00	21	0	7.5	0	7.5	0	0	t	2025-01-16 08:21:30+00	2025-01-16 17:01:03+00	f	0
1221	26	2025-02-05	08:09:00	17:03:00	9	0	8	0	7.5	0	0	t	2025-02-05 08:09:08+00	2025-02-05 17:03:49+00	f	0
985	3	2025-01-17	08:00:00	17:03:00	0	0	8	0	8	0	0	t	2025-01-17 08:00:08+00	2025-01-17 17:03:10+00	f	0
987	5	2025-01-17	08:05:00	17:11:00	5	0	8	0	7.5	0	0	t	2025-01-17 08:05:07+00	2025-01-17 17:11:46+00	f	0
1229	25	2025-02-05	08:14:00	17:06:00	14	0	8	0	7.5	0	0	t	2025-02-05 08:14:25+00	2025-02-05 17:06:54+00	f	0
1034	22	2025-01-20	08:15:00	18:09:00	15	0	8	0.5	7.5	0	0	t	2025-01-20 08:15:43+00	2025-01-20 18:09:39+00	f	0
1046	3	2025-01-21	07:59:00	17:01:00	0	0	8	0	8	0	0	t	2025-01-21 07:59:33+00	2025-01-21 17:01:11+00	f	0
1058	11	2025-01-21	08:30:00	18:09:00	30	0	7.5	0.5	7.5	0	0	t	2025-01-21 08:30:55+00	2025-01-21 18:09:10+00	f	0
1079	9	2025-01-22	08:55:00	\N	55	0	0	0	0	0	0	t	2025-01-22 08:55:50+00	2025-01-22 08:55:50+00	f	0
960	7	2025-01-16	08:02:00	18:44:00	2	0	8	1	8	0	0	f	2025-01-16 08:02:24+00	2025-01-22 10:26:24+00	f	0
1068	29	2025-01-22	08:09:00	17:09:00	9	0	8	0	7.5	0	0	t	2025-01-22 08:09:09+00	2025-01-22 17:09:36+00	f	0
1090	20	2025-01-23	08:01:00	17:02:00	1	0	8	0	7.5	0	0	t	2025-01-23 08:01:35+00	2025-01-23 17:02:07+00	f	0
1101	26	2025-01-23	08:45:00	17:02:00	45	0	7.25	0	7	0	0	t	2025-01-23 08:45:58+00	2025-01-23 17:02:20+00	f	0
1112	10	2025-01-24	08:20:00	13:41:00	20	199	4.25	0	4	0	0	t	2025-01-24 08:20:06+00	2025-01-24 13:41:47+00	f	0
1170	26	2025-02-03	07:57:00	17:02:00	0	0	8	0	8	0	0	t	2025-02-03 07:57:23+00	2025-02-03 17:02:45+00	f	0
1180	29	2025-02-03	08:13:00	17:05:00	13	0	8	0	7.5	0	0	t	2025-02-03 08:13:37+00	2025-02-03 17:05:43+00	f	0
1189	19	2025-02-03	14:33:00	17:13:00	333	0	2.25	0	2.5	0	0	t	2025-02-03 14:33:21+00	2025-02-03 17:13:52+00	f	0
1197	3	2025-02-04	08:03:00	17:01:00	3	0	8	0	7.5	0	0	t	2025-02-04 08:03:04+00	2025-02-04 17:01:10+00	f	0
1206	5	2025-02-04	08:08:00	17:11:00	8	0	8	0	7.5	0	0	t	2025-02-04 08:08:23+00	2025-02-04 17:11:38+00	f	0
1214	27	2025-02-04	13:01:00	17:18:00	241	0	3.75	0	4	0	0	t	2025-02-04 13:01:26+00	2025-02-04 17:18:34+00	f	0
1247	29	2025-02-06	08:13:00	17:08:00	13	0	8	0	7.5	0	0	t	2025-02-06 08:13:07+00	2025-02-06 17:08:18+00	f	0
1243	24	2025-02-06	08:11:00	17:21:00	11	0	8	0	7.5	0	0	t	2025-02-06 08:11:30+00	2025-02-06 17:21:11+00	f	0
1251	18	2025-02-06	08:15:00	18:10:00	15	0	8	0.5	7.5	0	0	t	2025-02-06 08:15:56+00	2025-02-06 18:10:00+00	f	0
1270	4	2025-02-07	08:16:00	17:01:00	16	0	7.5	0	7.5	0	0	t	2025-02-07 08:16:00+00	2025-02-07 17:01:07+00	f	0
1276	3	2025-02-07	08:44:00	17:04:00	44	0	7.25	0	7	0	0	t	2025-02-07 08:44:12+00	2025-02-07 17:04:55+00	f	0
1288	8	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1289	9	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1264	20	2025-02-07	08:11:00	17:12:00	11	0	8	0	7.5	0	0	t	2025-02-07 08:11:28+00	2025-02-07 17:12:58+00	f	0
1280	4	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1281	12	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1282	3	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1283	17	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1284	6	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1285	24	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1286	27	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1287	10	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1290	25	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1291	5	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1292	11	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1293	23	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1294	18	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1295	26	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1296	13	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1297	29	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1298	16	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1299	19	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1300	7	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
1301	424	2025-02-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-08 23:30:01+00	2025-02-08 23:30:01+00	f	0
813	19	2025-01-08	08:09:00	17:04:00	9	0	8	0	7.5	0	0	t	2025-01-08 08:09:51+00	2025-01-08 17:04:43+00	f	0
713	15	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
714	15	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
715	15	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
716	29	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
717	29	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
718	29	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
719	11	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
720	11	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
721	11	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
722	16	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
723	16	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
724	16	2025-05-02	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
725	8	2025-04-30	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
726	8	2025-05-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
748	27	2025-09-01	00:00:00	00:00:00	0	0	0	0	0	8	0	t	2025-01-06 16:34:13+00	2025-01-06 16:34:13+00	t	1
841	13	2025-01-09	08:18:00	17:03:00	18	0	7.5	0	7.5	0	0	t	2025-01-09 08:18:26+00	2025-01-09 17:03:14+00	f	0
827	26	2025-01-09	07:50:00	17:04:00	0	0	8	0	8	0	0	t	2025-01-09 07:50:19+00	2025-01-09 17:04:11+00	f	0
903	4	2025-01-13	08:11:00	17:04:00	11	0	8	0	7.5	0	0	t	2025-01-13 08:11:32+00	2025-01-13 17:04:38+00	f	0
921	19	2025-01-14	08:04:00	\N	4	0	0	0	0	0	0	t	2025-01-14 08:04:54+00	2025-01-14 08:04:54+00	f	0
922	5	2025-01-14	08:09:00	17:07:00	9	0	8	0	7.5	0	0	t	2025-01-14 08:09:44+00	2025-01-14 17:07:33+00	f	0
949	6	2025-01-15	08:15:00	18:48:00	15	0	8	1.5	7.5	0	0	t	2025-01-15 08:15:30+00	2025-01-15 18:48:49+00	f	0
961	20	2025-01-16	08:02:00	17:16:00	2	0	8	0	7.5	0	0	t	2025-01-16 08:02:39+00	2025-01-16 17:16:26+00	f	0
986	29	2025-01-17	08:04:00	17:03:00	4	0	8	0	7.5	0	0	t	2025-01-17 08:04:24+00	2025-01-17 17:03:14+00	f	0
999	4	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1000	12	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1001	23	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1002	17	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1003	6	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1004	22	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1005	10	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1006	20	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1007	24	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1008	5	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1009	25	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1010	11	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1011	18	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1012	7	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1013	8	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1014	9	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1015	14	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1016	15	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1017	29	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1018	3	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1019	16	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1020	19	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1021	26	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1022	13	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1023	27	2025-01-18	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-01-18 23:30:01+00	2025-01-18 23:30:01+00	f	0
1035	9	2025-01-20	08:17:00	17:02:00	17	0	7.5	0	7.5	0	0	t	2025-01-20 08:17:07+00	2025-01-20 17:02:10+00	f	0
864	12	2025-01-10	08:20:00	19:27:00	20	0	7.5	2	8	0	0	f	2025-01-10 08:20:19+00	2025-01-22 10:26:24+00	f	0
1368	24	2025-02-13	08:04:00	17:11:00	4	0	8	0	7.5	0	0	t	2025-02-13 08:04:17+00	2025-02-13 17:11:46+00	f	0
1377	424	2025-02-13	08:12:00	17:12:00	12	0	8	0	7.5	0	0	t	2025-02-13 08:12:17+00	2025-02-13 17:12:15+00	f	0
1373	25	2025-02-13	08:08:00	17:27:00	8	0	8	0	7.5	0	0	t	2025-02-13 08:08:46+00	2025-02-13 17:27:49+00	f	0
1380	22	2025-02-13	08:13:00	17:31:00	13	0	8	0	7.5	0	0	t	2025-02-13 08:13:34+00	2025-02-13 17:31:38+00	f	0
1393	15	2025-02-14	08:01:00	\N	1	0	0	0	0	0	0	t	2025-02-14 08:01:10+00	2025-02-14 08:01:10+00	f	0
1407	11	2025-02-14	08:17:00	18:08:00	17	0	7.5	0.5	7.5	0	0	t	2025-02-14 08:17:29+00	2025-02-14 18:08:23+00	f	0
1405	12	2025-02-14	08:15:00	18:45:00	15	0	8	1.5	7.5	0	0	t	2025-02-14 08:15:04+00	2025-02-14 18:45:30+00	f	0
1392	23	2025-02-14	08:00:00	18:46:00	0	0	8	1.5	8	0	0	t	2025-02-14 08:00:57+00	2025-02-14 18:46:26+00	f	0
1408	4	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1409	12	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1410	5	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1411	17	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1391	424	2025-02-14	07:59:00	17:00:00	0	0	8	0	8	0	0	t	2025-02-14 07:59:54+00	2025-02-14 17:00:02+00	f	0
1412	6	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1401	29	2025-02-14	08:11:00	17:00:00	11	0	8	0	7.5	0	0	t	2025-02-14 08:11:01+00	2025-02-14 17:00:41+00	f	0
1394	3	2025-02-14	08:02:00	17:00:00	2	0	8	0	7.5	0	0	t	2025-02-14 08:02:06+00	2025-02-14 17:00:46+00	f	0
1398	9	2025-02-14	08:09:00	17:01:00	9	0	8	0	7.5	0	0	t	2025-02-14 08:09:14+00	2025-02-14 17:01:20+00	f	0
1389	10	2025-02-14	07:55:00	17:01:00	0	0	8	0	8	0	0	t	2025-02-14 07:55:06+00	2025-02-14 17:01:24+00	f	0
1400	18	2025-02-14	08:09:00	17:01:00	9	0	8	0	7.5	0	0	t	2025-02-14 08:09:43+00	2025-02-14 17:01:52+00	f	0
1388	26	2025-02-14	07:49:00	17:02:00	0	0	8	0	8	0	0	t	2025-02-14 07:49:57+00	2025-02-14 17:02:07+00	f	0
1404	25	2025-02-14	08:13:00	17:02:00	13	0	8	0	7.5	0	0	t	2025-02-14 08:13:50+00	2025-02-14 17:02:31+00	f	0
1402	13	2025-02-14	08:11:00	17:05:00	11	0	8	0	7.5	0	0	t	2025-02-14 08:11:59+00	2025-02-14 17:05:18+00	f	0
1403	6	2025-02-14	08:13:00	17:07:00	13	0	8	0	7.5	0	0	t	2025-02-14 08:13:22+00	2025-02-14 17:07:44+00	f	0
1399	5	2025-02-14	08:09:00	17:08:00	9	0	8	0	7.5	0	0	t	2025-02-14 08:09:34+00	2025-02-14 17:08:50+00	f	0
1395	24	2025-02-14	08:02:00	17:12:00	2	0	8	0	7.5	0	0	t	2025-02-14 08:02:53+00	2025-02-14 17:12:16+00	f	0
1413	24	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1397	17	2025-02-14	08:07:00	17:14:00	7	0	8	0	7.5	0	0	t	2025-02-14 08:07:42+00	2025-02-14 17:14:49+00	f	0
1396	20	2025-02-14	08:03:00	17:19:00	3	0	8	0	7.5	0	0	t	2025-02-14 08:03:22+00	2025-02-14 17:19:35+00	f	0
1390	22	2025-02-14	07:57:00	17:19:00	0	0	8	0	8	0	0	t	2025-02-14 07:57:03+00	2025-02-14 17:19:35+00	f	0
1406	27	2025-02-14	08:15:00	17:27:00	15	0	8	0	7.5	0	0	t	2025-02-14 08:15:25+00	2025-02-14 17:27:26+00	f	0
1414	27	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1415	10	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1416	8	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1417	9	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1418	25	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1419	3	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1420	11	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1421	23	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1422	18	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1423	26	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1424	13	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1425	29	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1426	16	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1427	19	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1428	7	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1429	424	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1430	14	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1431	15	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1432	505	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1433	20	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1434	992	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1435	22	2025-02-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-15 23:30:01+00	2025-02-15 23:30:01+00	f	0
1437	15	2025-02-17	08:03:00	17:19:00	3	0	8	0	7.5	0	0	t	2025-02-17 08:03:10+00	2025-02-17 17:19:12+00	f	0
1439	25	2025-02-17	08:07:00	\N	7	0	0	0	0	0	0	t	2025-02-17 08:07:51+00	2025-02-17 08:07:51+00	f	0
1453	10	2025-02-17	08:34:00	17:00:00	34	0	7.25	0	7	0	0	t	2025-02-17 08:34:16+00	2025-02-17 17:00:37+00	f	0
1438	4	2025-02-17	08:06:00	17:01:00	6	0	8	0	7.5	0	0	t	2025-02-17 08:06:21+00	2025-02-17 17:01:58+00	f	0
1440	3	2025-02-17	08:08:00	17:02:00	8	0	8	0	7.5	0	0	t	2025-02-17 08:08:40+00	2025-02-17 17:02:08+00	f	0
1446	13	2025-02-17	08:16:00	17:07:00	16	0	7.5	0	7.5	0	0	t	2025-02-17 08:16:37+00	2025-02-17 17:07:16+00	f	0
1447	9	2025-02-17	08:17:00	17:08:00	17	0	7.5	0	7.5	0	0	t	2025-02-17 08:17:28+00	2025-02-17 17:08:33+00	f	0
1442	18	2025-02-17	08:10:00	17:11:00	10	0	8	0	7.5	0	0	t	2025-02-17 08:10:39+00	2025-02-17 17:11:06+00	f	0
1443	424	2025-02-17	08:14:00	17:14:00	14	0	8	0	7.5	0	0	t	2025-02-17 08:14:01+00	2025-02-17 17:14:04+00	f	0
1454	26	2025-02-17	08:57:00	17:15:00	57	0	7	0	7	0	0	t	2025-02-17 08:57:05+00	2025-02-17 17:15:51+00	f	0
1452	27	2025-02-17	08:30:00	17:16:00	30	0	7.5	0	7.5	0	0	t	2025-02-17 08:30:24+00	2025-02-17 17:16:55+00	f	0
1448	6	2025-02-17	08:17:00	17:18:00	17	0	7.5	0	7.5	0	0	t	2025-02-17 08:17:54+00	2025-02-17 17:18:07+00	f	0
1441	24	2025-02-17	08:10:00	17:18:00	10	0	8	0	7.5	0	0	t	2025-02-17 08:10:26+00	2025-02-17 17:18:21+00	f	0
1445	22	2025-02-17	08:15:00	17:18:00	15	0	8	0	7.5	0	0	t	2025-02-17 08:15:27+00	2025-02-17 17:18:46+00	f	0
1436	20	2025-02-17	08:00:00	17:18:00	0	0	8	0	8	0	0	t	2025-02-17 08:00:40+00	2025-02-17 17:18:53+00	f	0
1444	5	2025-02-17	08:15:00	17:21:00	15	0	8	0	7.5	0	0	t	2025-02-17 08:15:23+00	2025-02-17 17:21:22+00	f	0
1451	11	2025-02-17	08:29:00	18:30:00	29	0	7.5	1	7.5	0	0	t	2025-02-17 08:29:49+00	2025-02-17 18:30:23+00	f	0
1450	23	2025-02-17	08:22:00	18:37:00	22	0	7.5	1	7.5	0	0	t	2025-02-17 08:22:05+00	2025-02-17 18:37:23+00	f	0
1449	12	2025-02-17	08:21:00	18:51:00	21	0	7.5	1.5	7.5	0	0	t	2025-02-17 08:21:47+00	2025-02-17 18:51:51+00	f	0
1470	9	2025-02-18	08:25:00	17:00:00	25	0	7.5	0	7.5	0	0	t	2025-02-18 08:25:53+00	2025-02-18 17:00:46+00	f	0
1464	10	2025-02-18	08:14:00	17:01:00	14	0	8	0	7.5	0	0	t	2025-02-18 08:14:54+00	2025-02-18 17:01:38+00	f	0
1459	26	2025-02-18	08:08:00	17:02:00	8	0	8	0	7.5	0	0	t	2025-02-18 08:08:19+00	2025-02-18 17:02:41+00	f	0
1457	4	2025-02-18	08:06:00	17:02:00	6	0	8	0	7.5	0	0	t	2025-02-18 08:06:56+00	2025-02-18 17:02:53+00	f	0
1458	3	2025-02-18	08:07:00	17:04:00	7	0	8	0	7.5	0	0	t	2025-02-18 08:07:33+00	2025-02-18 17:04:15+00	f	0
1472	27	2025-02-18	08:38:00	17:08:00	38	0	7.25	0	7	0	0	t	2025-02-18 08:38:57+00	2025-02-18 17:08:07+00	f	0
1463	25	2025-02-18	08:09:00	17:09:00	9	0	8	0	7.5	0	0	t	2025-02-18 08:09:46+00	2025-02-18 17:09:11+00	f	0
1460	18	2025-02-18	08:08:00	17:18:00	8	0	8	0	7.5	0	0	t	2025-02-18 08:08:23+00	2025-02-18 17:18:12+00	f	0
1456	424	2025-02-18	08:05:00	17:20:00	5	0	8	0	7.5	0	0	t	2025-02-18 08:05:26+00	2025-02-18 17:20:01+00	f	0
1467	13	2025-02-18	08:17:00	17:22:00	17	0	7.5	0	7.5	0	0	t	2025-02-18 08:17:37+00	2025-02-18 17:22:41+00	f	0
1462	15	2025-02-18	08:09:00	17:33:00	9	0	8	0	7.5	0	0	t	2025-02-18 08:09:40+00	2025-02-18 17:33:50+00	f	0
1461	20	2025-02-18	08:08:00	17:35:00	8	0	8	0	7.5	0	0	t	2025-02-18 08:08:47+00	2025-02-18 17:35:31+00	f	0
1455	22	2025-02-18	08:03:00	17:44:00	3	0	8	0	7.5	0	0	t	2025-02-18 08:03:32+00	2025-02-18 17:44:42+00	f	0
1469	11	2025-02-18	08:25:00	18:07:00	25	0	7.5	0.5	7.5	0	0	t	2025-02-18 08:25:01+00	2025-02-18 18:07:37+00	f	0
1465	24	2025-02-18	08:15:00	18:13:00	15	0	8	0.5	7.5	0	0	t	2025-02-18 08:15:49+00	2025-02-18 18:13:08+00	f	0
1468	12	2025-02-18	08:21:00	19:45:00	21	0	7.5	2	7.5	0	0	t	2025-02-18 08:21:20+00	2025-02-18 19:45:22+00	f	0
1466	6	2025-02-18	08:17:00	19:47:00	17	0	7.5	2	7.5	0	0	t	2025-02-18 08:17:24+00	2025-02-18 19:47:01+00	f	0
1471	23	2025-02-18	08:29:00	19:48:00	29	0	7.5	2	7.5	0	0	t	2025-02-18 08:29:52+00	2025-02-18 19:48:09+00	f	0
1474	10	2025-02-19	08:06:00	17:01:00	6	0	8	0	7.5	0	0	t	2025-02-19 08:06:57+00	2025-02-19 17:01:01+00	f	0
1476	4	2025-02-19	08:09:00	17:01:00	9	0	8	0	7.5	0	0	t	2025-02-19 08:09:37+00	2025-02-19 17:01:10+00	f	0
1475	24	2025-02-19	08:08:00	17:01:00	8	0	8	0	7.5	0	0	t	2025-02-19 08:08:20+00	2025-02-19 17:01:12+00	f	0
1482	3	2025-02-19	08:14:00	17:02:00	14	0	8	0	7.5	0	0	t	2025-02-19 08:14:45+00	2025-02-19 17:02:51+00	f	0
1483	5	2025-02-19	08:15:00	17:03:00	15	0	8	0	7.5	0	0	t	2025-02-19 08:15:49+00	2025-02-19 17:03:26+00	f	0
1480	25	2025-02-19	08:13:00	17:04:00	13	0	8	0	7.5	0	0	t	2025-02-19 08:13:52+00	2025-02-19 17:04:59+00	f	0
1477	18	2025-02-19	08:11:00	17:05:00	11	0	8	0	7.5	0	0	t	2025-02-19 08:11:14+00	2025-02-19 17:05:14+00	f	0
1490	26	2025-02-19	08:33:00	17:06:00	33	0	7.25	0	7	0	0	t	2025-02-19 08:33:48+00	2025-02-19 17:06:09+00	f	0
1486	424	2025-02-19	08:16:00	17:11:00	16	0	7.5	0	7.5	0	0	t	2025-02-19 08:16:47+00	2025-02-19 17:11:10+00	f	0
1481	27	2025-02-19	08:14:00	17:13:00	14	0	8	0	7.5	0	0	t	2025-02-19 08:14:06+00	2025-02-19 17:13:40+00	f	0
1473	20	2025-02-19	08:01:00	17:19:00	1	0	8	0	7.5	0	0	t	2025-02-19 08:01:04+00	2025-02-19 17:19:52+00	f	0
1489	23	2025-02-19	08:30:00	17:45:00	30	0	7.5	0.5	7.5	0	0	t	2025-02-19 08:30:02+00	2025-02-19 17:45:21+00	f	0
1485	13	2025-02-19	08:16:00	17:48:00	16	0	7.5	0.5	7.5	0	0	t	2025-02-19 08:16:42+00	2025-02-19 17:48:08+00	f	0
1478	22	2025-02-19	08:11:00	17:52:00	11	0	8	0.5	7.5	0	0	t	2025-02-19 08:11:17+00	2025-02-19 17:52:57+00	f	0
1484	12	2025-02-19	08:16:00	18:26:00	16	0	7.5	1	7.5	0	0	t	2025-02-19 08:16:35+00	2025-02-19 18:26:26+00	f	0
1488	15	2025-02-19	08:29:00	18:30:00	29	0	7.5	1	7.5	0	0	t	2025-02-19 08:29:53+00	2025-02-19 18:30:35+00	f	0
1479	9	2025-02-19	08:13:00	16:31:00	13	29	7.25	0	7	0	0	t	2025-02-19 08:13:09+00	2025-02-19 16:31:27+00	f	0
1487	6	2025-02-19	08:17:00	17:16:00	17	0	7.5	0	7.5	0	0	t	2025-02-19 08:17:42+00	2025-02-19 17:16:37+00	f	0
1491	11	2025-02-19	09:27:00	18:24:00	87	0	6.5	1	6.5	0	0	t	2025-02-19 09:27:11+00	2025-02-19 18:24:50+00	f	0
1499	4	2025-02-20	08:11:00	\N	11	0	0	0	0	0	0	t	2025-02-20 08:11:11+00	2025-02-20 08:11:11+00	f	0
1506	6	2025-02-20	08:21:00	\N	21	0	0	0	0	0	0	t	2025-02-20 08:21:18+00	2025-02-20 08:21:18+00	f	0
1497	10	2025-02-20	08:10:00	15:24:00	10	96	6	0	5.5	0	0	t	2025-02-20 08:10:24+00	2025-02-20 15:24:49+00	f	0
1501	3	2025-02-20	08:13:00	17:01:00	13	0	8	0	7.5	0	0	t	2025-02-20 08:13:25+00	2025-02-20 17:01:00+00	f	0
1503	26	2025-02-20	08:14:00	17:02:00	14	0	8	0	7.5	0	0	t	2025-02-20 08:14:10+00	2025-02-20 17:02:07+00	f	0
1496	9	2025-02-20	08:09:00	17:03:00	9	0	8	0	7.5	0	0	t	2025-02-20 08:09:13+00	2025-02-20 17:03:09+00	f	0
1502	25	2025-02-20	08:13:00	17:07:00	13	0	8	0	7.5	0	0	t	2025-02-20 08:13:45+00	2025-02-20 17:07:14+00	f	0
1495	424	2025-02-20	08:06:00	17:08:00	6	0	8	0	7.5	0	0	t	2025-02-20 08:06:53+00	2025-02-20 17:08:31+00	f	0
1508	27	2025-02-20	09:52:00	17:10:00	112	0	6	0	6	0	0	t	2025-02-20 09:52:51+00	2025-02-20 17:10:26+00	f	0
1500	5	2025-02-20	08:13:00	17:14:00	13	0	8	0	7.5	0	0	t	2025-02-20 08:13:24+00	2025-02-20 17:14:24+00	f	0
1494	18	2025-02-20	08:06:00	17:16:00	6	0	8	0	7.5	0	0	t	2025-02-20 08:06:23+00	2025-02-20 17:16:07+00	f	0
1493	15	2025-02-20	08:06:00	17:30:00	6	0	8	0	7.5	0	0	t	2025-02-20 08:06:17+00	2025-02-20 17:30:16+00	f	0
1492	20	2025-02-20	08:03:00	17:30:00	3	0	8	0	7.5	0	0	t	2025-02-20 08:03:19+00	2025-02-20 17:30:20+00	f	0
1498	13	2025-02-20	08:10:00	17:43:00	10	0	8	0	7.5	0	0	t	2025-02-20 08:10:41+00	2025-02-20 17:43:55+00	f	0
1509	22	2025-02-20	09:53:00	17:56:00	113	0	6	0.5	6	0	0	t	2025-02-20 09:53:58+00	2025-02-20 17:56:58+00	f	0
1504	23	2025-02-20	08:16:00	18:02:00	16	0	7.5	0.5	7.5	0	0	t	2025-02-20 08:16:04+00	2025-02-20 18:02:16+00	f	0
1507	12	2025-02-20	08:24:00	18:26:00	24	0	7.5	1	7.5	0	0	t	2025-02-20 08:24:55+00	2025-02-20 18:26:53+00	f	0
1505	11	2025-02-20	08:19:00	18:31:00	19	0	7.5	1	7.5	0	0	t	2025-02-20 08:19:46+00	2025-02-20 18:31:25+00	f	0
1517	16	2025-02-21	08:09:00	\N	9	0	0	0	0	0	0	t	2025-02-21 08:09:25+00	2025-02-21 08:09:25+00	f	0
1523	13	2025-02-21	08:15:00	17:58:00	15	0	8	0.5	7.5	0	0	t	2025-02-21 08:15:33+00	2025-02-21 17:58:11+00	f	0
1513	3	2025-02-21	08:06:00	17:00:00	6	0	8	0	7.5	0	0	t	2025-02-21 08:06:24+00	2025-02-21 17:00:27+00	f	0
1516	9	2025-02-21	08:09:00	17:00:00	9	0	8	0	7.5	0	0	t	2025-02-21 08:09:20+00	2025-02-21 17:00:46+00	f	0
1519	4	2025-02-21	08:10:00	17:01:00	10	0	8	0	7.5	0	0	t	2025-02-21 08:10:40+00	2025-02-21 17:01:04+00	f	0
1512	424	2025-02-21	08:05:00	17:02:00	5	0	8	0	7.5	0	0	t	2025-02-21 08:05:11+00	2025-02-21 17:02:59+00	f	0
1521	25	2025-02-21	08:13:00	17:03:00	13	0	8	0	7.5	0	0	t	2025-02-21 08:13:39+00	2025-02-21 17:03:13+00	f	0
1527	26	2025-02-21	09:33:00	17:03:00	93	0	6.25	0	6	0	0	t	2025-02-21 09:33:17+00	2025-02-21 17:03:35+00	f	0
1510	18	2025-02-21	07:58:00	17:03:00	0	0	8	0	8	0	0	t	2025-02-21 07:58:05+00	2025-02-21 17:03:48+00	f	0
1525	27	2025-02-21	08:23:00	17:04:00	23	0	7.5	0	7.5	0	0	t	2025-02-21 08:23:42+00	2025-02-21 17:04:23+00	f	0
1515	5	2025-02-21	08:08:00	17:20:00	8	0	8	0	7.5	0	0	t	2025-02-21 08:08:27+00	2025-02-21 17:20:57+00	f	0
1524	12	2025-02-21	08:17:00	17:49:00	17	0	7.5	0.5	7.5	0	0	t	2025-02-21 08:17:17+00	2025-02-21 17:49:18+00	f	0
1518	15	2025-02-21	08:10:00	18:07:00	10	0	8	0.5	7.5	0	0	t	2025-02-21 08:10:29+00	2025-02-21 18:07:32+00	f	0
1514	20	2025-02-21	08:07:00	18:11:00	7	0	8	0.5	7.5	0	0	t	2025-02-21 08:07:43+00	2025-02-21 18:11:48+00	f	0
1520	22	2025-02-21	08:11:00	18:28:00	11	0	8	1	7.5	0	0	t	2025-02-21 08:11:19+00	2025-02-21 18:28:17+00	f	0
1526	11	2025-02-21	08:34:00	18:45:00	34	0	7.25	1.5	7	0	0	t	2025-02-21 08:34:24+00	2025-02-21 18:45:44+00	f	0
1511	23	2025-02-21	08:02:00	18:47:00	2	0	8	1.5	7.5	0	0	t	2025-02-21 08:02:19+00	2025-02-21 18:47:32+00	f	0
1522	6	2025-02-21	08:14:00	21:07:00	14	0	8	2.5	7.5	0	0	t	2025-02-21 08:14:02+00	2025-02-21 21:07:23+00	f	0
1528	4	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1529	12	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1530	23	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1531	17	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1532	6	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1533	24	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1534	27	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1535	10	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1536	8	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1537	9	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1538	25	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1539	3	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1540	5	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1541	11	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1542	18	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1543	26	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1544	13	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1545	29	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1546	16	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1547	19	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1548	7	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1549	14	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1550	15	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1551	505	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1552	20	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1553	992	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1554	22	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1555	424	2025-02-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-02-22 23:30:01+00	2025-02-22 23:30:01+00	f	0
1567	4	2025-02-24	08:25:00	\N	25	0	0	0	0	0	0	t	2025-02-24 08:25:56+00	2025-02-24 08:25:56+00	f	0
1569	6	2025-02-24	08:29:00	\N	29	0	0	0	0	0	0	t	2025-02-24 08:29:07+00	2025-02-24 08:29:07+00	f	0
1566	9	2025-02-24	08:17:00	17:00:00	17	0	7.5	0	7.5	0	0	t	2025-02-24 08:17:57+00	2025-02-24 17:00:53+00	f	0
1560	25	2025-02-24	08:07:00	17:01:00	7	0	8	0	7.5	0	0	t	2025-02-24 08:07:55+00	2025-02-24 17:01:03+00	f	0
1558	26	2025-02-24	08:06:00	17:02:00	6	0	8	0	7.5	0	0	t	2025-02-24 08:06:06+00	2025-02-24 17:02:37+00	f	0
1571	5	2025-02-24	12:46:00	17:03:00	240	0	4	0	4.5	0	0	t	2025-02-24 12:46:27+00	2025-02-24 17:03:50+00	f	0
1559	424	2025-02-24	08:07:00	17:04:00	7	0	8	0	7.5	0	0	t	2025-02-24 08:07:41+00	2025-02-24 17:04:30+00	f	0
1565	13	2025-02-24	08:16:00	17:05:00	16	0	7.5	0	7.5	0	0	t	2025-02-24 08:16:00+00	2025-02-24 17:05:14+00	f	0
1564	23	2025-02-24	08:15:00	17:05:00	15	0	8	0	7.5	0	0	t	2025-02-24 08:15:38+00	2025-02-24 17:05:33+00	f	0
1557	24	2025-02-24	08:02:00	17:05:00	2	0	8	0	7.5	0	0	t	2025-02-24 08:02:42+00	2025-02-24 17:05:39+00	f	0
1572	27	2025-02-24	12:52:00	17:06:00	240	0	4	0	4.5	0	0	t	2025-02-24 12:52:40+00	2025-02-24 17:06:57+00	f	0
1563	18	2025-02-24	08:12:00	17:08:00	12	0	8	0	7.5	0	0	t	2025-02-24 08:12:30+00	2025-02-24 17:08:01+00	f	0
1561	20	2025-02-24	08:10:00	17:14:00	10	0	8	0	7.5	0	0	t	2025-02-24 08:10:54+00	2025-02-24 17:14:37+00	f	0
1556	22	2025-02-24	07:59:00	17:14:00	0	0	8	0	8	0	0	t	2025-02-24 07:59:12+00	2025-02-24 17:14:40+00	f	0
1568	11	2025-02-24	08:28:00	17:20:00	28	0	7.5	0	7.5	0	0	t	2025-02-24 08:28:28+00	2025-02-24 17:20:51+00	f	0
1562	15	2025-02-24	08:11:00	17:21:00	11	0	8	0	7.5	0	0	t	2025-02-24 08:11:07+00	2025-02-24 17:21:35+00	f	0
1570	12	2025-02-24	08:29:00	17:21:00	29	0	7.5	0	7.5	0	0	t	2025-02-24 08:29:24+00	2025-02-24 17:21:56+00	f	0
1579	19	2025-02-25	08:14:00	\N	14	0	0	0	0	0	0	t	2025-02-25 08:14:04+00	2025-02-25 08:14:04+00	f	0
1587	4	2025-02-25	08:33:00	\N	33	0	0	0	0	0	0	t	2025-02-25 08:33:28+00	2025-02-25 08:33:28+00	f	0
1586	26	2025-02-25	08:31:00	17:09:00	31	0	7.25	0	7	0	0	t	2025-02-25 08:31:02+00	2025-02-25 17:09:53+00	f	0
1580	13	2025-02-25	08:16:00	17:33:00	16	0	7.5	0	7.5	0	0	t	2025-02-25 08:16:24+00	2025-02-25 17:33:12+00	f	0
1582	9	2025-02-25	08:22:00	17:08:00	22	0	7.5	0	7.5	0	0	t	2025-02-25 08:22:50+00	2025-02-25 17:08:42+00	f	0
1589	27	2025-02-25	09:29:00	17:11:00	89	0	6.5	0	6.5	0	0	t	2025-02-25 09:29:22+00	2025-02-25 17:11:21+00	f	0
1578	25	2025-02-25	08:13:00	17:11:00	13	0	8	0	7.5	0	0	t	2025-02-25 08:13:35+00	2025-02-25 17:11:43+00	f	0
1576	18	2025-02-25	08:10:00	17:12:00	10	0	8	0	7.5	0	0	t	2025-02-25 08:10:54+00	2025-02-25 17:12:39+00	f	0
1577	424	2025-02-25	08:11:00	17:15:00	11	0	8	0	7.5	0	0	t	2025-02-25 08:11:07+00	2025-02-25 17:15:24+00	f	0
1574	24	2025-02-25	08:08:00	17:15:00	8	0	8	0	7.5	0	0	t	2025-02-25 08:08:49+00	2025-02-25 17:15:59+00	f	0
1583	6	2025-02-25	08:22:00	17:21:00	22	0	7.5	0	7.5	0	0	t	2025-02-25 08:22:53+00	2025-02-25 17:21:09+00	f	0
1584	11	2025-02-25	08:28:00	18:03:00	28	0	7.5	0.5	7.5	0	0	t	2025-02-25 08:28:38+00	2025-02-25 18:03:15+00	f	0
1575	20	2025-02-25	08:10:00	17:30:00	10	0	8	0	7.5	0	0	t	2025-02-25 08:10:17+00	2025-02-25 17:30:12+00	f	0
1573	15	2025-02-25	08:07:00	17:36:00	7	0	8	0	7.5	0	0	t	2025-02-25 08:07:39+00	2025-02-25 17:36:40+00	f	0
1581	12	2025-02-25	08:22:00	17:36:00	22	0	7.5	0	7.5	0	0	t	2025-02-25 08:22:22+00	2025-02-25 17:36:45+00	f	0
1588	22	2025-02-25	08:47:00	17:37:00	47	0	7	0	7	0	0	t	2025-02-25 08:47:43+00	2025-02-25 17:37:42+00	f	0
1585	23	2025-02-25	08:30:00	18:52:00	30	0	7.5	1.5	7.5	0	0	t	2025-02-25 08:30:09+00	2025-02-25 18:52:06+00	f	0
1592	24	2025-02-26	08:06:00	17:31:00	6	0	8	0	7.5	0	0	t	2025-02-26 08:06:43+00	2025-02-26 17:31:13+00	f	0
1595	424	2025-02-26	08:11:00	17:12:00	11	0	8	0	7.5	0	0	t	2025-02-26 08:11:22+00	2025-02-26 17:12:44+00	f	0
1591	18	2025-02-26	08:04:00	17:22:00	4	0	8	0	7.5	0	0	t	2025-02-26 08:04:18+00	2025-02-26 17:22:10+00	f	0
1596	13	2025-02-26	08:13:00	17:28:00	13	0	8	0	7.5	0	0	t	2025-02-26 08:13:29+00	2025-02-26 17:28:34+00	f	0
1594	22	2025-02-26	08:09:00	17:31:00	9	0	8	0	7.5	0	0	t	2025-02-26 08:09:29+00	2025-02-26 17:31:13+00	f	0
1590	23	2025-02-26	07:52:00	18:18:00	0	0	8	1	8	0	0	t	2025-02-26 07:52:50+00	2025-02-26 18:18:51+00	f	0
1593	20	2025-02-26	08:09:00	12:03:00	9	240	3.75	0	3.5	0	0	t	2025-02-26 08:09:22+00	2025-02-26 12:03:21+00	f	0
1602	26	2025-02-26	08:27:00	17:03:00	27	0	7.5	0	7.5	0	0	t	2025-02-26 08:27:38+00	2025-02-26 17:03:42+00	f	0
1598	25	2025-02-26	08:14:00	17:05:00	14	0	8	0	7.5	0	0	t	2025-02-26 08:14:28+00	2025-02-26 17:05:33+00	f	0
1600	4	2025-02-26	08:19:00	17:10:00	19	0	7.5	0	7.5	0	0	t	2025-02-26 08:19:49+00	2025-02-26 17:10:33+00	f	0
1604	3	2025-02-26	16:48:00	17:10:00	468	0	0	0	0.5	0	0	t	2025-02-26 16:48:53+00	2025-02-26 17:10:48+00	f	0
1597	9	2025-02-26	08:14:00	17:15:00	14	0	8	0	7.5	0	0	t	2025-02-26 08:14:22+00	2025-02-26 17:15:28+00	f	0
1601	27	2025-02-26	08:22:00	17:26:00	22	0	7.5	0	7.5	0	0	t	2025-02-26 08:22:10+00	2025-02-26 17:26:16+00	f	0
1599	6	2025-02-26	08:14:00	17:28:00	14	0	8	0	7.5	0	0	t	2025-02-26 08:14:47+00	2025-02-26 17:28:02+00	f	0
1603	11	2025-02-26	08:30:00	18:31:00	30	0	7.5	1	7.5	0	0	t	2025-02-26 08:30:57+00	2025-02-26 18:31:23+00	f	0
1605	15	2025-02-26	18:50:00	18:50:00	590	0	0	1.5	-1.5	0	0	t	2025-02-26 18:50:40+00	2025-02-26 18:50:42+00	f	0
1619	11	2025-02-27	08:20:00	17:59:00	20	0	7.5	0.5	7.5	0	0	t	2025-02-27 08:20:31+00	2025-02-27 17:59:11+00	f	0
1617	25	2025-02-27	08:16:00	\N	16	0	0	0	0	0	0	t	2025-02-27 08:16:21+00	2025-02-27 08:16:21+00	f	0
1615	4	2025-02-27	08:12:00	17:01:00	12	0	8	0	7.5	0	0	t	2025-02-27 08:12:50+00	2025-02-27 17:01:26+00	f	0
1606	3	2025-02-27	07:55:00	17:02:00	0	0	8	0	8	0	0	t	2025-02-27 07:55:46+00	2025-02-27 17:02:01+00	f	0
1620	26	2025-02-27	08:21:00	17:02:00	21	0	7.5	0	7.5	0	0	t	2025-02-27 08:21:57+00	2025-02-27 17:02:24+00	f	0
1621	10	2025-02-27	09:34:00	17:02:00	94	0	6.25	0	6	0	0	t	2025-02-27 09:34:48+00	2025-02-27 17:02:34+00	f	0
1611	6	2025-02-27	08:10:00	17:07:00	10	0	8	0	7.5	0	0	t	2025-02-27 08:10:25+00	2025-02-27 17:07:55+00	f	0
1610	16	2025-02-27	08:09:00	17:13:00	9	0	8	0	7.5	0	0	t	2025-02-27 08:09:23+00	2025-02-27 17:13:52+00	f	0
1607	24	2025-02-27	08:02:00	17:17:00	2	0	8	0	7.5	0	0	t	2025-02-27 08:02:11+00	2025-02-27 17:17:37+00	f	0
1609	424	2025-02-27	08:08:00	17:20:00	8	0	8	0	7.5	0	0	t	2025-02-27 08:08:23+00	2025-02-27 17:20:33+00	f	0
1618	9	2025-02-27	08:18:00	17:23:00	18	0	7.5	0	7.5	0	0	t	2025-02-27 08:18:29+00	2025-02-27 17:23:28+00	f	0
1612	13	2025-02-27	08:10:00	17:24:00	10	0	8	0	7.5	0	0	t	2025-02-27 08:10:41+00	2025-02-27 17:24:22+00	f	0
1608	18	2025-02-27	08:06:00	17:32:00	6	0	8	0	7.5	0	0	t	2025-02-27 08:06:03+00	2025-02-27 17:32:33+00	f	0
1613	23	2025-02-27	08:10:00	17:36:00	10	0	8	0	7.5	0	0	t	2025-02-27 08:10:50+00	2025-02-27 17:36:16+00	f	0
1614	22	2025-02-27	08:12:00	17:51:00	12	0	8	0.5	7.5	0	0	t	2025-02-27 08:12:20+00	2025-02-27 17:51:47+00	f	0
1616	12	2025-02-27	08:16:00	17:57:00	16	0	7.5	0.5	7.5	0	0	t	2025-02-27 08:16:10+00	2025-02-27 17:57:04+00	f	0
1631	3	2025-02-28	08:10:00	\N	10	0	0	0	0	0	0	t	2025-02-28 08:10:22+00	2025-02-28 08:10:22+00	f	0
1634	10	2025-02-28	08:13:00	17:01:00	13	0	8	0	7.5	0	0	t	2025-02-28 08:13:36+00	2025-02-28 17:01:19+00	f	0
1639	9	2025-02-28	09:05:00	17:02:00	65	0	6.75	0	6.5	0	0	t	2025-02-28 09:05:03+00	2025-02-28 17:02:09+00	f	0
1628	4	2025-02-28	08:07:00	17:03:00	7	0	8	0	7.5	0	0	t	2025-02-28 08:07:44+00	2025-02-28 17:03:32+00	f	0
1636	13	2025-02-28	08:14:00	17:08:00	14	0	8	0	7.5	0	0	t	2025-02-28 08:14:10+00	2025-02-28 17:08:37+00	f	0
1633	27	2025-02-28	08:13:00	17:10:00	13	0	8	0	7.5	0	0	t	2025-02-28 08:13:28+00	2025-02-28 17:10:34+00	f	0
1623	26	2025-02-28	08:00:00	17:11:00	0	0	8	0	8	0	0	t	2025-02-28 08:00:52+00	2025-02-28 17:11:12+00	f	0
1629	20	2025-02-28	08:08:00	17:13:00	8	0	8	0	7.5	0	0	t	2025-02-28 08:08:20+00	2025-02-28 17:13:33+00	f	0
1622	24	2025-02-28	07:57:00	17:17:00	0	0	8	0	8	0	0	t	2025-02-28 07:57:20+00	2025-02-28 17:17:22+00	f	0
1624	424	2025-02-28	08:01:00	17:18:00	1	0	8	0	7.5	0	0	t	2025-02-28 08:01:42+00	2025-02-28 17:18:05+00	f	0
1630	16	2025-02-28	08:08:00	17:18:00	8	0	8	0	7.5	0	0	t	2025-02-28 08:08:26+00	2025-02-28 17:18:27+00	f	0
1635	6	2025-02-28	08:13:00	17:19:00	13	0	8	0	7.5	0	0	t	2025-02-28 08:13:55+00	2025-02-28 17:19:49+00	f	0
1626	18	2025-02-28	08:03:00	17:45:00	3	0	8	0.5	7.5	0	0	t	2025-02-28 08:03:44+00	2025-02-28 17:45:00+00	f	0
1625	22	2025-02-28	08:03:00	18:27:00	3	0	8	1	7.5	0	0	t	2025-02-28 08:03:08+00	2025-02-28 18:27:56+00	f	0
1641	3	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1637	11	2025-02-28	08:19:00	18:24:00	19	0	7.5	1	7.5	0	0	t	2025-02-28 08:19:19+00	2025-02-28 18:24:55+00	f	0
1632	15	2025-02-28	08:10:00	18:44:00	10	0	8	1	7.5	0	0	t	2025-02-28 08:10:35+00	2025-02-28 18:44:58+00	f	0
1638	12	2025-02-28	08:19:00	18:45:00	19	0	7.5	1.5	7.5	0	0	t	2025-02-28 08:19:29+00	2025-02-28 18:45:24+00	f	0
1627	23	2025-02-28	08:06:00	18:54:00	6	0	8	1.5	7.5	0	0	t	2025-02-28 08:06:41+00	2025-02-28 18:54:20+00	f	0
1640	4	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1642	12	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1643	23	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1644	17	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1645	6	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1646	24	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1647	27	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1648	10	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1649	8	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1650	9	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1651	25	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1652	5	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1653	11	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1654	18	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1655	26	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1656	13	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1657	29	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1658	16	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1659	19	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1660	7	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1661	22	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1662	14	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1663	15	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1664	505	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1665	20	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1666	992	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1667	424	2025-03-01	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-01 23:30:02+00	2025-03-01 23:30:02+00	f	0
1671	4	2025-03-03	08:03:00	\N	3	0	0	0	0	0	0	t	2025-03-03 08:03:57+00	2025-03-03 08:03:57+00	f	0
1672	23	2025-03-03	08:06:00	\N	6	0	0	0	0	0	0	t	2025-03-03 08:06:43+00	2025-03-03 08:06:43+00	f	0
1673	424	2025-03-03	08:09:00	\N	9	0	0	0	0	0	0	t	2025-03-03 08:09:01+00	2025-03-03 08:09:01+00	f	0
1674	25	2025-03-03	08:09:00	\N	9	0	0	0	0	0	0	t	2025-03-03 08:09:26+00	2025-03-03 08:09:26+00	f	0
1675	18	2025-03-03	08:10:00	\N	10	0	0	0	0	0	0	t	2025-03-03 08:10:15+00	2025-03-03 08:10:15+00	f	0
1676	15	2025-03-03	08:10:00	\N	10	0	0	0	0	0	0	t	2025-03-03 08:10:21+00	2025-03-03 08:10:21+00	f	0
1680	12	2025-03-03	08:18:00	\N	18	0	0	0	0	0	0	t	2025-03-03 08:18:04+00	2025-03-03 08:18:04+00	f	0
1681	6	2025-03-03	08:18:00	\N	18	0	0	0	0	0	0	t	2025-03-03 08:18:54+00	2025-03-03 08:18:54+00	f	0
1679	13	2025-03-03	08:17:00	17:01:00	17	0	7.5	0	7.5	0	0	t	2025-03-03 08:17:15+00	2025-03-03 17:01:56+00	f	0
1668	10	2025-03-03	07:45:00	17:02:00	0	0	8	0	8	0	0	t	2025-03-03 07:45:23+00	2025-03-03 17:02:56+00	f	0
1670	20	2025-03-03	08:03:00	17:13:00	3	0	8	0	7.5	0	0	t	2025-03-03 08:03:17+00	2025-03-03 17:13:34+00	f	0
1682	27	2025-03-03	08:31:00	17:16:00	31	0	7.25	0	7	0	0	t	2025-03-03 08:31:01+00	2025-03-03 17:16:07+00	f	0
1669	24	2025-03-03	08:03:00	17:19:00	3	0	8	0	7.5	0	0	t	2025-03-03 08:03:12+00	2025-03-03 17:19:53+00	f	0
1677	26	2025-03-03	08:12:00	17:34:00	12	0	8	0	7.5	0	0	t	2025-03-03 08:12:00+00	2025-03-03 17:34:41+00	f	0
1678	22	2025-03-03	08:13:00	18:17:00	13	0	8	1	7.5	0	0	t	2025-03-03 08:13:47+00	2025-03-03 18:17:31+00	f	0
1684	24	2025-03-04	08:01:00	\N	1	0	0	0	0	0	0	t	2025-03-04 08:01:48+00	2025-03-04 08:01:48+00	f	0
1686	6	2025-03-04	08:13:00	\N	13	0	0	0	0	0	0	t	2025-03-04 08:13:59+00	2025-03-04 08:13:59+00	f	0
1687	13	2025-03-04	08:15:00	\N	15	0	0	0	0	0	0	t	2025-03-04 08:15:17+00	2025-03-04 08:15:17+00	f	0
1685	10	2025-03-04	08:07:00	17:01:00	7	0	8	0	7.5	0	0	t	2025-03-04 08:07:08+00	2025-03-04 17:01:58+00	f	0
1683	26	2025-03-04	08:01:00	17:05:00	1	0	8	0	7.5	0	0	t	2025-03-04 08:01:11+00	2025-03-04 17:05:45+00	f	0
1688	22	2025-03-04	17:16:00	\N	496	0	0	0	0	0	0	t	2025-03-04 17:16:22+00	2025-03-04 17:16:22+00	f	0
1692	13	2025-03-05	08:16:00	\N	16	0	0	0	0	0	0	t	2025-03-05 08:16:17+00	2025-03-05 08:16:17+00	f	0
1693	6	2025-03-05	08:18:00	\N	18	0	0	0	0	0	0	t	2025-03-05 08:18:00+00	2025-03-05 08:18:00+00	f	0
1689	10	2025-03-05	07:51:00	17:01:00	0	0	8	0	8	0	0	t	2025-03-05 07:51:05+00	2025-03-05 17:01:36+00	f	0
1690	26	2025-03-05	07:57:00	17:10:00	0	0	8	0	8	0	0	t	2025-03-05 07:57:45+00	2025-03-05 17:10:13+00	f	0
1691	22	2025-03-05	08:07:00	18:24:00	7	0	8	1	7.5	0	0	t	2025-03-05 08:07:06+00	2025-03-05 18:24:50+00	f	0
1694	10	2025-03-06	07:58:00	17:05:00	0	0	8	0	8	0	0	t	2025-03-06 07:58:56+00	2025-03-06 17:05:08+00	f	0
1695	26	2025-03-06	08:04:00	17:32:00	4	0	8	0	7.5	0	0	t	2025-03-06 08:04:25+00	2025-03-06 17:32:36+00	f	0
1696	22	2025-03-06	08:13:00	17:51:00	13	0	8	0.5	7.5	0	0	t	2025-03-06 08:13:40+00	2025-03-06 17:51:40+00	f	0
1697	10	2025-03-07	08:02:00	17:07:00	2	0	8	0	7.5	0	0	t	2025-03-07 08:02:15+00	2025-03-07 17:07:51+00	f	0
1698	26	2025-03-07	08:07:00	17:09:00	7	0	8	0	7.5	0	0	t	2025-03-07 08:07:53+00	2025-03-07 17:09:06+00	f	0
1699	22	2025-03-07	08:12:00	17:43:00	12	0	8	0	7.5	0	0	t	2025-03-07 08:12:34+00	2025-03-07 17:43:35+00	f	0
1700	4	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1701	3	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1702	12	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1703	23	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1704	17	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1705	6	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1706	24	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1707	10	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1708	8	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1709	9	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1710	25	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1711	27	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1712	5	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1713	11	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1714	18	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1715	26	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1716	13	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1717	29	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1718	16	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1719	19	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1720	7	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1721	22	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1722	14	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1723	15	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1724	505	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1725	20	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1726	992	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1727	424	2025-03-08	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-08 23:30:02+00	2025-03-08 23:30:02+00	f	0
1728	26	2025-03-09	07:59:00	17:20:00	0	0	8	0	8	0	0	t	2025-03-09 07:59:44+00	2025-03-09 17:20:29+00	f	0
1729	10	2025-03-10	07:53:00	\N	0	0	0	0	0	0	0	t	2025-03-10 07:53:06+00	2025-03-10 07:53:06+00	f	0
1730	22	2025-03-10	07:58:00	17:34:00	0	0	8	0	8	0	0	t	2025-03-10 07:58:50+00	2025-03-10 17:34:46+00	f	0
1731	22	2025-03-11	08:06:00	\N	6	0	0	0	0	0	0	t	2025-03-11 08:06:25+00	2025-03-11 08:06:25+00	f	0
1732	22	2025-03-12	08:12:00	\N	12	0	0	0	0	0	0	t	2025-03-12 08:12:26+00	2025-03-12 08:12:26+00	f	0
1733	22	2025-03-13	08:18:00	\N	18	0	0	0	0	0	0	t	2025-03-13 08:18:58+00	2025-03-13 08:18:58+00	f	0
1734	22	2025-03-14	10:08:00	17:56:00	128	0	5.75	0.5	5.5	0	0	t	2025-03-14 10:08:26+00	2025-03-14 17:56:09+00	f	0
1735	4	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1736	3	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1737	12	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1738	23	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1739	17	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1740	6	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1741	24	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1742	10	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1743	8	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1744	9	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1745	25	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1746	27	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1747	5	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1748	11	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1749	18	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1750	26	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1751	13	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1752	29	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1753	16	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1754	19	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1755	7	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1756	22	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1757	14	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1758	15	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1759	505	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1760	20	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1761	992	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1762	424	2025-03-15	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-15 23:30:02+00	2025-03-15 23:30:02+00	f	0
1763	22	2025-03-18	07:56:00	\N	0	0	0	0	0	0	0	t	2025-03-18 07:56:42+00	2025-03-18 07:56:42+00	f	0
1764	22	2025-03-19	08:16:00	17:19:00	16	0	7.5	0	7.5	0	0	t	2025-03-19 08:16:42+00	2025-03-19 17:19:31+00	f	0
1765	22	2025-03-20	07:54:00	\N	0	0	0	0	0	0	0	t	2025-03-20 07:54:14+00	2025-03-20 07:54:14+00	f	0
1766	22	2025-03-21	08:17:00	\N	17	0	0	0	0	0	0	t	2025-03-21 08:17:50+00	2025-03-21 08:17:50+00	f	0
1767	4	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1768	3	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1769	12	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1770	23	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1771	17	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1772	6	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1773	24	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1774	10	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1775	8	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1776	9	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1777	25	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1778	27	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1779	5	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1780	11	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1781	18	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1782	26	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1783	13	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1784	29	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1785	16	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1786	19	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1787	7	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1788	14	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1789	15	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1790	505	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1791	20	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1792	22	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1793	992	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1794	424	2025-03-22	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-22 23:30:02+00	2025-03-22 23:30:02+00	f	0
1795	22	2025-03-24	07:55:00	\N	0	0	0	0	0	0	0	t	2025-03-24 07:55:53+00	2025-03-24 07:55:53+00	f	0
1796	22	2025-03-25	09:37:00	\N	97	0	0	0	0	0	0	t	2025-03-25 09:37:17+00	2025-03-25 09:37:17+00	f	0
1797	22	2025-03-26	08:15:00	17:04:00	15	0	8	0	7.5	0	0	t	2025-03-26 08:15:16+00	2025-03-26 17:04:53+00	f	0
1798	22	2025-03-28	08:04:00	\N	4	0	0	0	0	0	0	t	2025-03-28 08:04:15+00	2025-03-28 08:04:15+00	f	0
1799	4	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1800	3	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1801	12	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1802	23	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1803	17	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1804	6	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1805	24	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1806	10	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1807	8	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1808	9	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1809	25	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1810	27	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1811	5	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1812	11	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1813	18	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1814	26	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1815	13	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1816	29	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1817	16	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1818	19	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1819	7	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1820	14	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1821	15	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1822	505	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1823	20	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1824	22	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1825	992	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1826	424	2025-03-29	00:00:00	00:00:00	0	0	8	0	8	0	0	t	2025-03-29 23:30:02+00	2025-03-29 23:30:02+00	f	0
1827	22	2025-03-31	08:13:00	\N	13	0	0	0	0	0	0	t	2025-03-31 08:13:03+00	2025-03-31 08:13:03+00	f	0
1828	22	2025-04-01	08:12:00	\N	12	0	0	0	0	0	0	t	2025-04-01 08:12:54+00	2025-04-01 08:12:54+00	f	0
1829	22	2025-04-02	08:07:00	\N	7	0	0	0	0	0	0	t	2025-04-02 08:07:01+00	2025-04-02 08:07:01+00	f	0
\.


--
-- Data for Name: days_off_by_schedule; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.days_off_by_schedule (id, start_date, end_date, leave_type, created_at, updated_at) FROM stdin;
1	2025-01-01	2025-01-01	1	2025-01-06 14:10:16+00	2025-01-06 14:10:16+00
2	2025-01-27	2025-01-31	1	2025-01-06 14:10:45+00	2025-01-06 14:10:45+00
3	2025-04-07	2025-04-07	1	2025-01-06 14:11:06+00	2025-01-06 14:11:06+00
4	2025-04-30	2025-05-02	1	2025-01-06 14:11:21+00	2025-01-06 14:11:21+00
6	2025-09-01	2025-09-02	1	2025-01-06 14:12:04+00	2025-01-06 14:12:04+00
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: leave_days; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.leave_days (id, user_id, days_off_in_advance, days_off, award_days_off, days_off_to_june, compensatory_day_off, carried_days_off, days_off_to_used, days_off_in_advance_to_used, year, created_at, updated_at) FROM stdin;
2	3	5	1	3	0.25	0	3	0	0	2024	\N	\N
3	4	0	1	0	5.5	0	0	0	0	2024	\N	\N
4	5	5	1	3	0	0	2.75	0	0	2024	\N	\N
5	6	5	1	2	0	0	2	0	0	2024	\N	\N
48	11	3	2	1	0.75	0	3	0	0	2025	\N	\N
6	7	5	1	2	0	0	0	0	0	2024	\N	\N
32	18	0	2	0	0	0	0	0	0	2025	\N	\N
7	8	5	1	2	0	0	1.5	0	0	2024	\N	\N
51	9	3	2	1	0	0	0	1.5	0	2025	\N	\N
8	9	5	1	1	0	0	0.5	0	0	2024	\N	\N
53	505	0	1	0	0	0	0	0	0	2025	\N	\N
9	10	5	1	1	0	0	0.5	0	0	2024	\N	\N
34	24	0	2	0	0.5	0	0	0.5	0	2025	\N	\N
10	11	5	1	1	0.75	0	3	0	0	2024	\N	\N
11	12	5	1	0	5.75	0	3	0	0	2024	\N	\N
12	13	0	1	0	0.25	0	3	0	0	2024	\N	\N
47	20	0	1	0	4	0	0	0	0	2025	\N	\N
13	14	0	1	0	2.25	0	0	0	0	2024	\N	\N
35	25	0	2	0	1	0	0	0	0	2025	\N	\N
14	15	0	1	0	3.5	0	0	0	0	2024	\N	\N
45	10	3	2	1	0	0	0.5	0	0	2025	\N	\N
15	16	0	1	0	2.5	0	0	0	0	2024	\N	\N
16	17	0	1	0	1	0	0	0	0	2024	\N	\N
44	27	0	2	0	0	0	0	0	0	2025	\N	\N
17	18	0	1	0	0	0	0	0	0	2024	\N	\N
52	26	0	2	0	0	0	0	0	0	2025	\N	\N
18	19	0	1	0	1.25	0	0	0	0	2024	\N	\N
19	20	0	1	0	4	0	0	0	0	2024	\N	\N
31	16	0	2	0	2.5	0	0	0	0	2025	\N	\N
20	22	0	1	0	0	0	0	0	0	2024	\N	\N
46	19	0	2	0	1	0	0	0.25	0	2025	\N	\N
21	23	0	1	0	0.5	0	0	0	0	2024	\N	\N
33	22	0	2	0	0	0	0	0	0	2025	\N	\N
22	24	0	1	0	1	0	0	0	0	2024	\N	\N
49	5	3	2.75	3	0	0	2.75	0.25	0	2025	\N	\N
23	25	0	0.5	0	1	0	0	0	0	2024	\N	\N
28	4	0	2	1	5.5	0	0	0	0	2025	\N	\N
24	27	0	0.5	0	0	0	0	0	0	2024	\N	\N
39	12	3	2	0	4.75	0	3	1	0	2025	\N	\N
25	29	0	0.5	0	0	0	0	0	0	2024	\N	\N
29	8	3	2.5	2	0	0	1.5	0.5	0	2025	\N	\N
50	7	3	2	1.5	0	0	0	1.5	0	2025	\N	\N
54	992	0	1	0	0	0	0	0	0	2025	\N	\N
30	13	3	2	0	0	0	3	1.25	0	2025	\N	\N
55	424	0	1	0	0	0	0	0	0	2025	\N	\N
38	14	0	2	2	2.25	0	0	0	0	2025	\N	\N
43	23	0	2.5	0	0	0	0	1	0	2025	\N	\N
41	15	0	2	0	3.5	0	0	0	0	2025	\N	\N
40	17	0	2	0	0	0	0	1	0	2025	\N	\N
27	3	3	2	3	0.25	0	3	0	0	2025	\N	\N
36	29	0	2	0	0	0	0	0	0	2025	\N	\N
42	6	3	2	2	0	0	2	0	0	2025	\N	\N
\.


--
-- Data for Name: leave_days_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.leave_days_log (id, user_id, days_off_in_advance, days_off, award_days_off, days_off_to_june, compensatory_day_off, carried_days_off, days_off_to_used, days_off_in_advance_to_used, pl_to_used_m, plan_pl_to_used_m, pl_in_advance_to_used_m, un_pl_to_used_m, sl_to_used_m, compensatory_day_to_used_m, all_pl_available_m, all_pl_to_used_m, all_pl_remain_to_use_m, date, created_at, updated_at) FROM stdin;
1	3	11	1	3	0	0	0	0	0	0	0	0	0	0	0	4	0	4	2024-11-30	\N	\N
2	4	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
3	5	11	1	3	0	0	0	0	0	0	0	0	0	0	0	4	0	4	2024-11-30	\N	\N
4	6	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-11-30	\N	\N
5	7	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-11-30	\N	\N
6	8	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-11-30	\N	\N
7	9	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-11-30	\N	\N
8	10	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-11-30	\N	\N
9	11	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-11-30	\N	\N
10	12	11	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
11	13	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
12	14	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
13	15	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
14	16	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
15	17	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
16	18	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
17	19	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
18	20	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
19	22	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
20	23	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
21	24	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
22	25	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
23	27	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
24	29	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-11-30	\N	\N
26	13	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
27	25	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
29	14	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
30	4	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
31	12	11	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
32	23	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
33	17	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
34	6	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-12-31	\N	\N
35	27	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
36	10	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-12-31	\N	\N
37	19	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
38	20	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
39	24	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
40	5	11	1	3	0	0	0	0	0	0	0	0	0	0	0	4	0	4	2024-12-31	\N	\N
41	3	11	1	3	0	0	0	0	0	0	0	0	0	0	0	4	0	4	2024-12-31	\N	\N
42	18	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
43	22	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
44	7	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-12-31	\N	\N
45	9	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-12-31	\N	\N
46	15	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
47	29	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
48	11	11	1	1	0	0	0	0	0	0	0	0	0	0	0	2	0	2	2024-12-31	\N	\N
49	16	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2024-12-31	\N	\N
50	8	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2024-12-31	\N	\N
52	27	0	3	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
53	4	0	1	0	5.5	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
54	12	11	1	0	5.75	0	3	0	0	0	0	0	0	0	0	4	0	4	2025-01-31	\N	\N
55	23	0	2.5	0	0	0	0	1	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
56	17	0	3	0	1	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
57	6	11	1	2	0	0	2	0	0	0	0	0	0	0	0	5	0	5	2025-01-31	\N	\N
58	24	0	1	0	1	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
59	10	11	1	1	0	0	0.5	0	0	0	0	0	0	0	0	2.5	0	2.5	2025-01-31	\N	\N
60	8	11	1	2	0	0	1.5	0	0	0	0	0	0	0	0	4.5	0	4.5	2025-01-31	\N	\N
61	9	11	1	1	0	0	0.5	0	0	0	0	0	0	0	0	2.5	0	2.5	2025-01-31	\N	\N
62	25	0	1	0	1	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
63	5	11	1	3	0	0	2.75	0	0	0	0	0	0	0	0	6.75	0	6.75	2025-01-31	\N	\N
64	3	11	1	3	0.25	0	3	0	0	0	0	0	0	0	0	7	0	7	2025-01-31	\N	\N
65	11	11	1	1	0.75	0	3	0	0	0	0	0	0	0	0	5	0	5	2025-01-31	\N	\N
66	18	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
67	29	0	1	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
68	16	0	1	0	2.5	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
69	19	0	3	0	1	0	0	0.25	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
70	26	0	2	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
71	13	0	1	0	0.25	0	3	0	0	0	0	0	0	0	0	4	0	4	2025-01-31	\N	\N
72	7	11	1	2	0	0	0	0	0	0	0	0	0	0	0	3	0	3	2025-01-31	\N	\N
73	20	0	1	0	4	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
74	22	0	3	0	0	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
75	14	0	2	1	2.25	0	0	0	0	0	0	0	0	0	0	2	0	2	2025-01-31	\N	\N
76	15	0	1	0	3.5	0	0	0	0	0	0	0	0	0	0	1	0	1	2025-01-31	\N	\N
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	0001_01_01_000003_create_check_in_out_table	1
5	0001_01_01_000004_create_application_form_table	1
6	0001_01_01_000005_create_overtime_form_table	1
7	0001_01_01_000006_create_leave_days_table	1
8	0001_01_01_000007_create_teams_table	1
9	0001_01_01_000008_create_projects_table	1
10	0001_01_01_000009_create_leave_days_log_table	1
11	2024_11_12_143116_create_team_users_table	1
12	2024_11_12_143117_create_project_users_table	1
14	2025_01_06_100001_create_days_off_by_schedule_table	2
15	2025_01_06_100002_add_new_column_to_check_in_out_table	3
34	2025_01_16_100001_update_users_table	4
35	2025_01_16_100002_create_skill_category_table	4
36	2025_01_16_100003_create_skill_item_table	4
37	2025_01_16_100004_create_user_skill_history_table	4
38	2025_01_22_100001_update_users_table	5
\.


--
-- Data for Name: overtime_form; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.overtime_form (id, user_id, date, start_time, end_time, over_time, official_working_hours, paid_leave, total_time, verify_status, approved_by, created_by, created_at, updated_by, updated_at) FROM stdin;
1	7	2025-01-02	08:01:00	18:17:00	0.5	8	0	8.5	t	6	7	2025-01-02 18:17:40+00	6	2025-01-03 17:39:27+00
2	7	2025-01-03	07:57:00	18:12:00	0.5	8	0	8.5	t	6	7	2025-01-08 12:22:00+00	6	2025-01-22 10:26:24+00
3	7	2025-01-10	09:07:00	17:03:00	0	6	2	8	t	6	7	2025-01-15 13:19:00+00	6	2025-01-22 10:26:24+00
4	7	2025-01-13	08:26:00	18:56:00	1	8	0	9	t	6	7	2025-01-15 13:19:08+00	6	2025-01-22 10:26:24+00
5	7	2025-01-16	08:02:00	18:44:00	0.5	8	0	8.5	t	6	7	2025-01-20 10:00:38+00	6	2025-01-22 10:26:24+00
6	7	2025-01-20	09:55:00	18:10:00	0.5	6	2	8.5	t	6	7	2025-01-22 09:47:38+00	6	2025-01-22 10:26:24+00
7	12	2025-01-10	08:20:00	19:27:00	1.5	8	0	9.5	t	6	12	2025-01-22 09:48:25+00	6	2025-01-22 10:26:24+00
8	12	2025-01-16	08:23:00	20:07:00	1.5	8	0	9.5	t	6	12	2025-01-22 09:48:34+00	6	2025-01-22 10:26:24+00
9	12	2025-02-11	08:15:00	18:51:00	1	8	0	9	f	\N	12	2025-02-18 19:45:39+00	\N	2025-02-18 19:45:39+00
10	12	2025-02-10	08:15:00	18:16:00	0.5	8	0	8.5	f	\N	12	2025-02-18 19:45:50+00	\N	2025-02-18 19:45:50+00
11	12	2025-02-13	08:14:00	20:07:00	1.5	8	0	9.5	f	\N	12	2025-02-18 19:46:02+00	\N	2025-02-18 19:46:02+00
12	12	2025-02-14	08:15:00	18:45:00	1	8	0	9	f	\N	12	2025-02-18 19:46:08+00	\N	2025-02-18 19:46:08+00
13	12	2025-02-17	08:21:00	18:51:00	1	8	0	9	f	\N	12	2025-02-18 19:46:13+00	\N	2025-02-18 19:46:13+00
14	12	2025-02-18	08:21:00	19:45:00	1.5	8	0	9.5	f	\N	12	2025-02-18 19:46:18+00	\N	2025-02-18 19:46:18+00
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: project_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.project_users (id, project_id, user_id, created_at, updated_at) FROM stdin;
1	6	5	\N	\N
2	6	7	\N	\N
3	1	8	\N	\N
4	3	9	\N	\N
5	2	10	\N	\N
6	2	12	\N	\N
7	4	13	\N	\N
8	2	15	\N	\N
9	5	17	\N	\N
11	5	19	\N	\N
12	4	20	\N	\N
13	4	22	\N	\N
10	5	18	\N	\N
14	6	23	\N	\N
15	2	24	\N	\N
16	5	25	\N	\N
17	2	27	\N	\N
18	5	29	\N	\N
\.


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, project_name, user_id) FROM stdin;
1	MIETEN	14
2	FSVM	6
3	VAC	6
4	CIMA	14
5	SF	16
6	RSS	6
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
OkPhDiCcBUrZW1T8n7oA70R6KcyiRfBFkkbtElZI	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFZtTFJrdjlWeFAwbjlzWUxNTlRnZHB6WGlyV3RaTlJFOWhjQUcxcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735541330
CH1R6h7hySiU9PIABIAC2dJUSgD8gllVguNDHrQ4	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiRkF0SnFIc2dmZ0VrVXJoWHg0N1o1N2ZXQVhYckhHeVBmU0xsZTRhRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549315
ZEIWAOq07vLA2SefnDuz8d9q9ug4wwPzl6cTvisc	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiWElUaWsyMVg2N3JFYmU5a2NHSUxHdHQwTFJPNk81NnRYdlpzM2VOVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549319
YCW7rfrPwlBk5Xa8HgaLEUymCZM0ZZiZnKRVU0RV	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoibFdBV0FlNm8zOGdKWTdqaDZKdGJRNUFhUGZNaWlUVkpOUUdlWm94RyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549322
SAfQ0H3MjFHKN26LOHXxwjUvetdh3apPUYv81vGD	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHNYcGFiV3VtTnRWakJ4Znk1Nmo4VHlsVDR3UXhhbzJMTVdPeWZiRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549324
zc70yxBAVt6gmfEHoO6IPwrHr6fVbbspYq7f6LLL	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3h6OVZGRXdrOFR0MHJJZWw4THltRTZ1ZEJic3g1dVdlTGVyOHIwOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549326
vDSGytXv5jXUex8FtAaSysXPzLCK9CYyX007M28d	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoicmtrRzdlNVJKb2dzSXZGZkg5WjZ6Q2liSjVZSmY1M3VnNGxVQk15eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549331
h3tFuFooHfIWO6SNQdpgmqK5D7TvjHZzvr6qpeB7	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoid3JRcTBNMzlqWHpUS2Y4YzZsUzZud1dNejBSdjZvbWNCazljbWJlNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549335
guiRFD33ENZK6zU4U1MncVMwOB0xyM3ZM5P9EyBC	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoidXlndFp3M3RlaXNIR2xheTZaWlRnQXNXU3ZGaGdtTmRpZWNOVGl1NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549337
b6Rmhe7CzlyQvTk1mYLBrEWCG72oFjWslYXPV5gx	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiNkhzN3dVZHFNS3dRcXhialExdjVRZ0Jlb1BlczFFRmZIUWhxVG9IbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549362
W7bhujnk6aMcOSPVAU5W8xZwFlQZr44RzR470v7a	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiYjRsZ1c4VjI1Z2F3SVF6MDZJZlVhRHp6UkJrU3NQa0hONnlXSVRpNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549427
cynJ5lY68gLU3U8xkUbT0XzngC9zIuAAn9ynRS3r	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiZE1nZHFBdnZrYmFhTmFBUnRHdmZla2JqM2RuenZuMm1QdFhvUWUzTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549489
kMyggt1ZvUWhvXg12blc02HGFLpvfD7KAC4rG5CC	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHpNNmdzTVdlMlA2bWU3czhOam5zVVQ1dllIOGF0dk56VGZETUFIYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549493
gA9lQyNe4Wg1aDu14QTIBHhis9ZZ7IwwFjidvd0G	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiWE00N1VqREg3VzZPcWZoR0R6UjUxb0FQOUZsWnNzWXlwZ3ViVlB4UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735549494
76g0zlL7ULfk7rIPONnWnJNgCA9HcHzdHlJ2BtPt	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiRzhvMVdVdkdBNTlLY21CdUlhdGJmUVZRajJTNnBNTXNtcHhIQ0Z5VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735549499
ykXvKvg4uJszGnVsBCqPuxzwBAIC2Bn12Ykekuye	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoia1dkdVV3Y2M0MnNpSUZUYUFqZ0s1TFFTaFBhU2hPODM0T0RxQUs3YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735550205
LYQO61lNVlMKEZJulgHLVAseoTwxOqGFzpsfjyAX	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ2tpN2VTQ0lvUVd5V21hS1YxYWNrU3NxdVRzOFo3NUpnUTdRd0ZGTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735552836
vxNB3oRZFoWrP1wuwAX9gnsUsIAsGBjFTChoQPxn	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoidVV5SnhOanNGcHdpeHlMR2VQdFpaQkt3THZ1a2hZN1d2dGRVazdGdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552839
QId5XU87gYw6rbNeKYB7GZAU2L3ZlYhStyRfnyeL	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaEZhRVlSZjN3azlESksyT3lZRFE2NklNY29FY3Z0SGhoTEd3WUxuQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552842
fhMBKIZqXrTSauZJd3BjnRU6VgqVueahw5FqAj16	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHZwODJuQ1g5QWVmOWk4WGdsb3BtT3dwZVRBSnRCUGlCNFJXbE9tQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552843
8jVVOVhqtpJ7UXyiDKlPbRYIKo75lN8Zwr21F1SF	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGxvVmxDcDJJcjdTdmI1WFBpSzBPNGN3OElWbVZ2MmhpTFRyaDJGMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552845
Fy25zSWkp2fwgScbQs495m3dgxNZRpbA6z0CUgle	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoia3B3Y0JIekl6YzNZaURWWHpVVnFmUnpqMUZYN0tVancxTEc0Q3l4ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552848
7ztTq3OQcjSpGCgmF2RNlbs83Gr1jzqkFP1p9R5y	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiMUI3M28ycXp3RUxUMFhIVGFBbkVqdjBOVDVmY09Dd2xXWEs1bDBSWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735552863
E9w9WTtkwPF9yxC07O8tK9j7hocBS687AZFm52fY	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWhKQjNHcWVDRFJzZ0dGblBCYlRubm4wTUs1STM5cXZ3OGtsdXpXRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552879
UnZqt17klfyBzu3yvGA0BXAQBKl4H2oIA7hSUVZ2	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiblJZNU1OOXZyb1c1QTFQNXBBRG9sYmdEUlJMVmdRa0JydXl4S1R6YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552884
Vc5TMJoh77lbEANLSKkB8HEeK1I9iZNEqhjScqyL	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2plZG50anRIeFlmemF1NUxyQXVSc0NodHN6QkoydjZGTDJlNnNPMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552895
MUk6Fsw7s2Ihtz5lZ29kov6v15seJ3DO8UmX0qcS	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiNXl1T25WTG5vNzVhUklBQlVtbG9ZUjZVRjh5YnRUMm9vblJ4SWo4byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735552906
2uy5ayn4GSqUUvUcRW9Wev245y0UklTPCY4EH91L	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiVlJhN0ZhbURGdFMwbW1sSjJEQTN0cW5tRFR3VVNFMm40bzdyRGlGbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735552917
u1oaIFZm8rbqGsQtw7uFB6SEy0wI5wnUWAzYBqN8	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoicUNWQzlCZWN6YkJXQ0h2eXRHZ0FHTEtuNUg5NkpOdExkZkZQUHdLaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735552981
gh7oVlPqwGRS43ayi65STSYuPFVRXhczUl9XlByX	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36	YToyOntzOjY6Il90b2tlbiI7czo0MDoiMjJFdndsdDJkTnoxWjNHdlRYaThibEVOUHRWZE9xYmtHYUE3TTFzRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735552991
80lNIb0en4Z6Z2dllcfk8vmugdSFHp2CIopm01xP	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiV1VveDVWOFZkZ3A5R1VhZm9NVGJhdTB0cDVRNEJ4UWs3Z3VBRmlUWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735553230
TR4oG8xCXVCBlYJ2dsRM64pj5oNk8EW73BttRyQC	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFo1N0ZUWGRkeDB6MFFCSFRQY0R6UENXTFVEVDFNQ3NmWk5FY3d5ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735553561
C7k2ZiFhVUk1G8Bx8ILc0SekPMajuA0xYLBimPt9	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoibmdNUXQxT1MzajQzbDczc2hsTXFibTl2Tm9STFprNEdPa2c0NG1XZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735553563
DUcqXvMYGddooPk4pfWVJQm9sKZsaE9mO87u9Arv	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiTnlLTVhoS2hpSlBuckNKOUlNcjN1cUFnaEUxZWlxa2tndG9LRHlsUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735553571
piDlc8l29NbPpB8W5GpfnoQGr1vgfofYyqUjul56	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiMklQVzg3YmRESjMyQjBBdFduSnFjNGVYR0swekVOWFZkQnhlczZzciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735609105
bvQ6zyYOsdrg7185N1vFk2a3nXAuw63YjFLWoKp5	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzJudU5wTWJacG9VN0EzcFlSbW9uTm5jNDZySDFxRHpEYTZCVzdreCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735609109
t8CyKXInSXiSUJhggH0zi3EQveX8ZzLwRR9pSIck	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoibjJIVzBKcU5pcVU5Uk9rdDBqbkVaNm5VVVNvWktsNFAxTjEyczFEZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735609141
9jtgUhM4Hwz01cE5rZPBedUntP5mLzsGe2CuB6Ou	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiRm1YYjMySHoyNWpTV2FhU1ZtQkNKYzFMamZYUEhKRHJEMGJMbUtQMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735609150
IyfmPZon1ZDMyeRH8hOTdlXdzyMUexEcXgTFL3Cc	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiU3VKNGtoMHBXSVZ4ajBQZHJzUElxaHdjMVQ3RDM0QlVNcHpPVm82dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735609168
aGBaE7fDERfTPOg9A6hQhfVzZwuNQHsd3EV28ldK	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiNXVMVXZXbjZaUW43NDJBRFc5OG5FQnRsS09PcWpEOHhCc2NsZGhzOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735609177
M78QMZ4AaaLwTYdHhZINYIInFj5rwXnsywSpDxhy	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoidTVZS0NxYnRicVRhY2FVODgxWDlJYXBGbTRhVEFtUlBkbURNeXgzeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735609196
0E5u1YZGdA6EnScQFOAmsP4Jeb9QenTAYg9CowYw	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTJRVDhVbFlhWlIwT20xZE1JVktGWkdIQWZQM0tmcjVhWjFrdDVGbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735609199
AD98vEWNsXnUsg3mLPFHJ35BGPbNlmgqa0lGiW61	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoibG1GaGVsTmJocElqRHRnTHF0M2VZbkxIVUFZbTY3T3pReVVpVm01QSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735609210
iF0TqYoQFhLKtZ2pLzT4MiiEDgQd4HZh9h6Plj45	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiUVJncVhteFNVaVl4OXN2Tk5oMjY0MG5CRHlCcnU3bGhsVFM3Z1U2MiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735609240
VvKfx92mvJOj0glqqbbfrRABXWQe0TWtVlmspJkG	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDRiaTZzVnl5b0tqYzBpQ05vM1BlSExWR2Y1MTlsdmcxTG9FbER5SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735610202
rASIvphrp7GUQ5TBnqfy7QISqzHuYVmPvIHbMsPm	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YTozOntzOjY6Il90b2tlbiI7czo0MDoiU05YUWVSWVpmVHdiblMzczlnTUxVd2JYUnhXRTdDNW5ONW44QUlxYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xNzIuMjUuMTAwLjIyMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=	1735610205
7fr5MXyi1dUGGVWyJtQsEvZb4elyMiCTsWeTXwDg	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiYWNxV3JpSmxnVDd4SE05NlZhdEpQbWprZEI2dnJuMExybDN6c3pPVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735610214
Ys023cMfdFDoGrmuyzzn6Lq4EL9PR09vn0vA5a5x	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoiZ0JSN2w2UUk0MDZjend0UzZmcVE1a3ByS28yTGFDNkFxUjJtOFlOdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735610238
DMjZsIqZTCGN2oUYRMZPJAi545QyLUDbZ1LLakVb	\N	172.25.100.10	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0	YToyOntzOjY6Il90b2tlbiI7czo0MDoicXZCUXpxZWhRcFlDbXpJbU1WUFk0OG9CT3RncTBtdUZ1SWtNeHNhTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1735610245
\.


--
-- Data for Name: skill_category; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.skill_category (id, code, name, display_order, is_featured, text_color, bg_color, description, created_at, updated_at) FROM stdin;
11	\N	Operating System	1	f	\N	\N	\N	2025-01-20 16:44:30	2025-01-20 16:48:10
13	\N	Containerization & Virtualization	2	f	\N	\N	\N	2025-01-20 16:47:59	2025-01-20 16:48:23
1	\N	Cloud Platform	3	f	\N	\N	Ex. AWS, Azure,...	2025-01-20 09:41:38	2025-01-20 16:48:31
2	\N	Salesforce	4	f	\N	\N	\N	2025-01-20 11:01:11	2025-01-20 16:48:43
3	\N	DataSpider	5	f	\N	\N	\N	2025-01-20 11:01:22	2025-01-20 16:48:47
5	\N	Database	6	f	\N	\N	\N	2025-01-20 11:01:42	2025-01-20 16:49:17
4	\N	Programming Language	7	f	\N	\N	\N	2025-01-20 11:01:34	2025-01-20 16:49:21
8	\N	Backend	10	f	\N	\N	\N	2025-01-20 11:02:49	2025-01-20 16:49:51
7	\N	Web Server	9	f	\N	\N	Ex. Apache Tomcat, IIS,...	2025-01-20 11:02:16	2025-01-20 16:49:56
6	\N	IDE	8	f	\N	\N	\N	2025-01-20 11:01:52	2025-01-20 16:50:10
14	\N	Others	1000	f	\N	\N	\N	2025-01-20 16:54:43	2025-01-20 16:54:55
12	\N	Version Control	15	f	\N	\N	\N	2025-01-20 16:44:58	2025-01-20 18:19:03
10	\N	Build Tool	14	f	\N	\N	\N	2025-01-20 16:44:21	2025-01-20 18:19:09
9	\N	Frontend	11	f	\N	\N	\N	2025-01-20 11:04:00	2025-01-20 18:19:43
16	\N	Mobile	12	f	\N	\N	\N	2025-01-20 18:16:30	2025-01-20 18:19:50
15	\N	AI (Artificial Intelligence)	13	f	\N	\N	\N	2025-01-20 17:27:28	2025-01-20 18:19:56
\.


--
-- Data for Name: skill_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.skill_item (id, category_id, code, name, display_order, is_featured, text_color, bg_color, description, created_at, updated_at) FROM stdin;
54	9	\N	Bootstrap 5	0	f	\N	\N	\N	2025-01-20 16:35:04	2025-01-20 16:35:04
2	1	\N	Azure	2	f	\N	\N	Microsoft Azure: Cloud Computing Services	2025-01-20 11:31:52	2025-01-20 11:32:19
55	9	\N	jQuery	0	f	\N	\N	\N	2025-01-20 16:35:20	2025-01-20 16:35:20
56	9	\N	ReactJS	0	f	\N	\N	\N	2025-01-20 16:35:34	2025-01-20 16:35:34
57	9	\N	Next.js	0	f	\N	\N	\N	2025-01-20 16:35:49	2025-01-20 16:35:49
1	1	\N	AWS	1	f	\N	\N	Amazon Web Services.	2025-01-20 11:17:02	2025-01-20 11:37:30
3	1	\N	GCP	3	f	\N	\N	Google Cloud Platform.	2025-01-20 11:32:00	2025-01-20 11:37:33
5	2	\N	Visualforce	2	f	\N	\N	Visualforce is a framework that allows developers to build custom user interfaces that can be hosted natively on Lightning Platform.	2025-01-20 11:35:23	2025-01-20 11:37:39
4	2	\N	Apex	1	f	\N	\N	Apex is a strongly typed, object-oriented programming language that allows developers to execute flow and transaction control statements on Salesforce servers in conjunction with calls to the API.	2025-01-20 11:34:35	2025-01-20 11:37:43
7	4	\N	C/C++	0	f	\N	\N	\N	2025-01-20 11:49:58	2025-01-20 11:49:58
8	4	\N	C#	0	f	\N	\N	\N	2025-01-20 11:50:03	2025-01-20 11:50:08
9	4	\N	VB	0	f	\N	\N	Visual Basic.	2025-01-20 11:52:21	2025-01-20 11:52:21
10	4	\N	Java	0	f	\N	\N	\N	2025-01-20 11:52:33	2025-01-20 11:52:33
11	4	\N	Javascript	0	f	\N	\N	\N	2025-01-20 11:52:41	2025-01-20 11:52:41
12	4	\N	Typescript	0	f	\N	\N	\N	2025-01-20 11:52:50	2025-01-20 11:52:50
13	4	\N	PowerShell	0	f	\N	\N	\N	2025-01-20 11:53:02	2025-01-20 11:53:02
14	4	\N	Python	0	f	\N	\N	\N	2025-01-20 11:53:15	2025-01-20 11:53:15
15	4	\N	PHP	0	f	\N	\N	\N	2025-01-20 11:53:24	2025-01-20 11:53:24
16	4	\N	Ruby	0	f	\N	\N	\N	2025-01-20 11:53:30	2025-01-20 11:53:30
17	4	\N	Perl	0	f	\N	\N	\N	2025-01-20 11:53:37	2025-01-20 11:53:37
18	4	\N	Groovy	0	f	\N	\N	\N	2025-01-20 11:53:46	2025-01-20 11:53:46
19	4	\N	Kotlin	0	f	\N	\N	\N	2025-01-20 11:53:57	2025-01-20 11:53:57
20	4	\N	Golang	0	f	\N	\N	\N	2025-01-20 11:54:03	2025-01-20 11:54:03
21	4	\N	Dart	0	f	\N	\N	\N	2025-01-20 11:54:08	2025-01-20 11:54:08
22	4	\N	Rust	0	f	\N	\N	\N	2025-01-20 11:54:18	2025-01-20 11:54:18
23	4	\N	Swift	0	f	\N	\N	\N	2025-01-20 11:54:28	2025-01-20 11:54:28
24	5	\N	Oracle	1	f	\N	\N	\N	2025-01-20 11:55:55	2025-01-20 11:55:55
26	5	\N	MySQL/MariaDB	3	f	\N	\N	\N	2025-01-20 11:56:17	2025-01-20 11:56:17
27	5	\N	PostgreSQL	4	f	\N	\N	\N	2025-01-20 11:56:53	2025-01-20 11:56:53
28	5	\N	MongoDB	5	f	\N	\N	\N	2025-01-20 11:57:09	2025-01-20 11:57:09
29	5	\N	Redis	6	f	\N	\N	\N	2025-01-20 11:57:19	2025-01-20 11:57:19
25	5	\N	SQL Server	2	f	\N	\N	\N	2025-01-20 11:56:01	2025-01-20 11:58:18
6	3	\N	DataSpider Studio	1	f	\N	\N	\N	2025-01-20 11:49:30	2025-01-20 13:12:53
30	3	\N	DataSpider Server	2	f	\N	\N	\N	2025-01-20 13:13:01	2025-01-20 13:13:01
31	6	\N	Visual Studio Code	0	f	\N	\N	\N	2025-01-20 16:20:02	2025-01-20 16:20:02
32	6	\N	Visual Studio	0	f	\N	\N	\N	2025-01-20 16:20:11	2025-01-20 16:20:11
33	6	\N	IntelliJ	0	f	\N	\N	IDEA, PHPStorm, PyCharm, RubyMine,...	2025-01-20 16:20:48	2025-01-20 16:20:48
34	6	\N	Android Studio	0	f	\N	\N	\N	2025-01-20 16:21:02	2025-01-20 16:21:02
35	6	\N	Xcode	0	f	\N	\N	\N	2025-01-20 16:21:26	2025-01-20 16:21:26
36	6	\N	NetBeans	0	f	\N	\N	\N	2025-01-20 16:21:32	2025-01-20 16:21:46
37	7	\N	IIS	0	f	\N	\N	\N	2025-01-20 16:22:22	2025-01-20 16:22:22
38	7	\N	Apache Tomcat	0	f	\N	\N	\N	2025-01-20 16:22:30	2025-01-20 16:22:30
39	7	\N	Nginx	0	f	\N	\N	\N	2025-01-20 16:22:55	2025-01-20 16:22:55
40	7	\N	Apache HTTP Server	0	f	\N	\N	\N	2025-01-20 16:23:56	2025-01-20 16:23:56
41	7	\N	Jetty	0	f	\N	\N	\N	2025-01-20 16:24:16	2025-01-20 16:24:16
42	7	\N	IBM WebSphere	0	f	\N	\N	\N	2025-01-20 16:25:09	2025-01-20 16:25:09
43	7	\N	Oracle WebLogic	0	f	\N	\N	\N	2025-01-20 16:26:00	2025-01-20 16:26:00
44	7	\N	Gunicorn	0	f	\N	\N	\N	2025-01-20 16:26:19	2025-01-20 16:26:19
45	8	\N	PHP Laravel	0	f	\N	\N	\N	2025-01-20 16:26:43	2025-01-20 16:26:43
46	8	\N	DotNet	0	f	\N	\N	\N	2025-01-20 16:29:58	2025-01-20 16:29:58
47	8	\N	Python Django	0	f	\N	\N	\N	2025-01-20 16:30:07	2025-01-20 16:30:07
48	8	\N	CakePHP	0	f	\N	\N	\N	2025-01-20 16:30:36	2025-01-20 16:30:36
49	8	\N	Java Spring	0	f	\N	\N	\N	2025-01-20 16:30:46	2025-01-20 16:30:46
51	8	\N	Grails (Groovy)	0	f	\N	\N	\N	2025-01-20 16:32:14	2025-01-20 16:32:43
50	8	\N	Rails (Ruby)	0	f	\N	\N	\N	2025-01-20 16:31:47	2025-01-20 16:32:55
52	9	\N	HTML5	0	f	\N	\N	\N	2025-01-20 16:34:45	2025-01-20 16:34:45
53	9	\N	CSS3	0	f	\N	\N	\N	2025-01-20 16:34:53	2025-01-20 16:34:53
58	9	\N	Angular	0	f	\N	\N	\N	2025-01-20 16:36:02	2025-01-20 16:36:02
59	9	\N	VueJS	0	f	\N	\N	\N	2025-01-20 16:36:08	2025-01-20 16:36:08
60	9	\N	Alpine.js	0	f	\N	\N	\N	2025-01-20 16:36:30	2025-01-20 16:36:30
61	9	\N	Svelte	0	f	\N	\N	\N	2025-01-20 16:36:47	2025-01-20 16:36:47
62	8	\N	NodeJS	0	f	\N	\N	\N	2025-01-20 16:37:43	2025-01-20 16:37:43
63	9	\N	Tailwind CSS	0	f	\N	\N	\N	2025-01-20 16:38:11	2025-01-20 16:38:11
64	11	\N	Windows	0	f	\N	\N	\N	2025-01-20 16:50:40	2025-01-20 16:50:40
65	11	\N	Ubuntu	0	f	\N	\N	\N	2025-01-20 16:50:47	2025-01-20 16:50:47
66	11	\N	CentOS, Rocky Linux	0	f	\N	\N	\N	2025-01-20 16:51:11	2025-01-20 16:51:11
67	11	\N	RedHat	0	f	\N	\N	\N	2025-01-20 16:51:18	2025-01-20 16:51:18
68	11	\N	Solaris	0	f	\N	\N	\N	2025-01-20 16:51:28	2025-01-20 16:51:28
69	13	\N	Docker	0	f	\N	\N	\N	2025-01-20 16:51:38	2025-01-20 16:51:38
70	13	\N	Kubernetes	0	f	\N	\N	\N	2025-01-20 16:51:54	2025-01-20 16:51:54
71	13	\N	WSL	0	f	\N	\N	\N	2025-01-20 16:52:07	2025-01-20 16:52:07
72	10	\N	Webpack	0	f	\N	\N	\N	2025-01-20 16:53:31	2025-01-20 16:53:31
73	10	\N	Vite	0	f	\N	\N	\N	2025-01-20 16:53:38	2025-01-20 16:53:38
74	10	\N	Parcel	0	f	\N	\N	\N	2025-01-20 16:54:06	2025-01-20 16:54:06
75	12	\N	SVN	0	f	\N	\N	\N	2025-01-20 16:54:13	2025-01-20 16:54:13
76	12	\N	GIT	0	f	\N	\N	\N	2025-01-20 16:54:21	2025-01-20 16:54:21
77	14	\N	WinSCP	0	f	\N	\N	\N	2025-01-20 16:55:48	2025-01-20 16:55:48
78	14	\N	Tera Term	0	f	\N	\N	\N	2025-01-20 16:56:04	2025-01-20 16:56:04
79	2	\N	Lightning	3	f	\N	\N	\N	2025-01-20 17:15:01	2025-01-20 17:15:17
80	6	\N	Eclipse	0	f	\N	\N	\N	2025-01-20 17:24:21	2025-01-20 17:24:21
81	15	\N	Machine Learning Algorithms	0	f	\N	\N	\N	2025-01-20 17:27:59	2025-01-20 17:27:59
82	15	\N	TensorFlow	0	f	\N	\N	\N	2025-01-20 17:28:20	2025-01-20 17:28:20
83	15	\N	OpenCV	0	f	\N	\N	\N	2025-01-20 17:28:26	2025-01-20 17:28:26
84	15	\N	PyTorch	0	f	\N	\N	\N	2025-01-20 17:28:33	2025-01-20 17:28:33
86	16	\N	Native iOS (swift)	0	f	\N	\N	\N	2025-01-20 18:18:04	2025-01-20 18:18:04
85	16	\N	Native Android (Java, Kotlin)	0	f	\N	\N	\N	2025-01-20 18:17:40	2025-01-20 18:18:16
87	16	\N	React Native	0	f	\N	\N	\N	2025-01-20 18:18:39	2025-01-20 18:18:39
88	16	\N	Flutter	0	f	\N	\N	\N	2025-01-20 18:18:49	2025-01-20 18:18:49
\.


--
-- Data for Name: team_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.team_users (id, team_id, user_id, role, created_at, updated_at) FROM stdin;
2	5	5	2	2024-12-31 16:35:35	2024-12-31 16:35:39
3	5	6	1	2024-12-31 16:35:45	2024-12-31 16:35:47
4	5	7	2	2024-12-31 16:35:50	2024-12-31 16:35:52
5	5	8	2	2024-12-31 16:35:56	2024-12-31 16:35:57
6	5	9	2	2024-12-31 16:35:58	2024-12-31 16:36:00
8	6	11	2	2024-12-31 16:36:28	2024-12-31 16:36:29
9	5	12	2	2024-12-31 16:36:37	2024-12-31 16:36:39
10	6	13	2	2024-12-31 16:36:41	2024-12-31 16:36:42
11	6	14	1	2024-12-31 16:36:44	2024-12-31 16:36:45
12	5	15	2	2024-12-31 16:36:48	2024-12-31 16:36:50
13	7	16	1	2024-12-31 16:37:30	2024-12-31 16:37:31
14	7	17	2	2024-12-31 16:37:33	2024-12-31 16:37:35
15	7	18	2	2024-12-31 16:37:37	2024-12-31 16:37:41
16	7	19	2	2024-12-31 16:37:45	2024-12-31 16:37:46
17	6	20	2	2024-12-31 16:37:48	2024-12-31 16:37:50
18	6	22	2	2024-12-31 16:37:51	2024-12-31 16:37:52
19	5	23	2	2024-12-31 16:37:54	2024-12-31 16:38:12
20	5	24	2	2024-12-31 16:38:15	2024-12-31 16:38:17
21	7	25	2	2024-12-31 16:38:20	2024-12-31 16:38:23
22	5	27	2	2024-12-31 16:38:28	2024-12-31 16:38:29
23	7	29	2	2024-12-31 16:38:31	2024-12-31 16:38:33
7	5	10	2	2024-12-31 16:36:02	2025-01-22 14:19:23
\.


--
-- Data for Name: teams; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.teams (id, team_name) FROM stdin;
5	LongKB
6	LongTT
7	DungNT
\.


--
-- Data for Name: user_skill_history; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_skill_history (id, user_id, skill, description, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, role, email_verified_at, join_date, password, remember_token, created_at, updated_at, skill, skill_updated_at) FROM stdin;
1	Takeshi Kashiwagi	takeshi_kashiwagi@bip.co.jp	0	\N	2022-12-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	\N	2024-12-31 09:32:07	2024-12-31 09:32:07	\N	\N
2	Nguyen Thi Hong Trang	trangnh@bip.com.vn	9	\N	2008-04-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	\N	2024-12-31 09:32:07	2024-12-31 09:32:07	\N	\N
4	Hoang Ha Diep	diephh@bip.com.vn	2	\N	2024-01-17	$2y$12$8CzP4E5wUb.q8gy9MbdaH.uS2f7Aotn1kPxKQBcEpfAaefhdNinWq	p7GSCQFJB2WewULaui5l8xtw2zpJjuSA99W9NVpgoqAAZBanGRepHrAJDuKk	2024-12-31 09:32:07	2025-01-02 08:16:34	\N	\N
3	Nguyen Thanh Hao	haont@bip.com.vn	2	\N	2009-07-23	$2y$12$SzkPMnfGJa7qVwSSff8WMun5kkGO7zZqG.cdA7Y9tHk9aWAdOycg.	g5U6UKSDxSkad7LZ4Ogl96VwFPn2QJ1yGh33lvtSuSEA7zM5TRK5Bn9bfa2P	2024-12-31 09:32:07	2025-01-03 13:09:57	\N	\N
12	Do Tuan Thanh	thanhdt@bip.com.vn	1	\N	2020-12-07	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	nwkwyNzUlY87RXZDW0i80XA3Ifsoogvy3Tc9ceBFvzV0y2Hyq1vPpPCIKvkK	2024-12-31 09:32:07	2024-12-31 09:32:07	\N	\N
23	Tran Anh Duc	ducta@bip.com.vn	1	\N	2024-11-04	$2y$12$AEbKzH7w34tEoETysYu3mO/h4A/aztjBivQwjNRZiFUsp6m71DJ6K	JcEvb2S7zeLyyxR7HIUBSlE44So3l4ykkVkPttEf71ncL3F6l0kCGxbZucCo	2024-12-31 09:32:07	2025-02-05 08:13:29	\N	\N
17	Nguyen Tien Trung	trungnt1@bip.com.vn	1	\N	2024-09-04	$2y$12$uTJHP.lCT8ooXkmk9W6JxOuny3IYQwICQd5S4kmzEmf6e5d2nnp9a	f3qAJZaMhFRyOehz2egNy8opRVpfeZKbbPDL2zEUNPRSrBx7E8cyb1mD2hp1	2024-12-31 09:32:07	2024-12-31 17:01:44	\N	\N
6	Kieu Bao Long	longkb@bip.com.vn	1	\N	2011-03-01	$2y$12$8iJ.zMt3V4o.VKAkZxib0elAbvdAdhaXZ7HtF/JmLA7GRTeWBYfkC	\N	2024-12-31 09:32:07	2024-12-31 17:02:00	\N	\N
24	Nguyen Xuan Truong	truongnx@bip.com.vn	1	\N	2024-11-04	$2y$12$.Thum2zQ61W2bmrkebhVuOPZ4UzwY/p9D.yclRNeeMYh/mg/xW5AK	05ZqXLl4JU4Fffx4Ye6pUeOMnrqxhlSMdA7ueSiEPqCLSqymoAlhIxsjFAbv	2024-12-31 09:32:07	2025-01-21 13:43:40	{"1":0,"2":0,"3":0,"4":0,"5":0,"79":0,"6":0,"30":0,"8":0,"7":0,"21":0,"20":0,"18":1,"10":3,"11":2,"19":0,"17":0,"15":0,"13":1,"14":0,"16":0,"22":0,"23":0,"12":0,"9":0,"24":0,"25":3,"26":2,"27":1,"28":0,"29":0,"34":0,"80":1,"33":3,"36":1,"32":0,"31":3,"35":0,"40":0,"38":0,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":1,"49":3,"62":0,"45":0,"47":0,"50":0,"60":0,"58":0,"54":3,"53":3,"52":3,"55":1,"57":0,"56":1,"61":0,"63":0,"59":0,"74":0,"73":0,"72":0,"66":0,"67":0,"68":0,"65":1,"64":3,"76":3,"75":1,"69":1,"70":0,"71":1,"78":0,"77":0,"81":0,"83":0,"84":0,"82":0,"88":0,"85":0,"86":0,"87":0}	\N
10	Nguyen Minh Vu	vunm@bip.com.vn	1	\N	2018-01-02	$2y$12$AnzSL5OkUChRhALZr.duDuOiEKA4UZQA.3Nqe8K.MYl1Zo2ko1oN6	aCQXQgiZIqd21UfuttXkHPk99G7R1joaTagMwntoj9IOIeJOmD2NMeMbgKRj	2024-12-31 09:32:07	2024-12-31 17:01:48	\N	\N
8	Nguyen Thanh Trung	trungnt@bip.com.vn	1	\N	2014-08-04	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	oDq8sUBKxN9MUQ7GNYMuFUVv2g1i1LODtNy2RqFCwVdS8EMaIc8X43FAAMu4	2024-12-31 09:32:07	2025-01-21 08:38:54	{"1":1,"2":1,"3":0,"4":1,"5":1,"79":0,"6":1,"30":0,"8":0,"7":0,"21":0,"20":0,"18":0,"10":0,"11":0,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":0,"9":0,"24":0,"25":0,"26":0,"27":0,"28":0,"29":0,"34":0,"80":0,"33":0,"36":0,"32":0,"31":0,"35":0,"40":0,"38":0,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":0,"49":0,"62":0,"45":0,"47":0,"50":0,"60":0,"58":0,"54":0,"53":0,"52":0,"55":0,"57":0,"56":0,"61":0,"63":0,"59":0,"74":0,"73":0,"72":0,"66":1,"67":1,"68":0,"65":1,"64":5,"76":0,"75":0,"69":0,"70":0,"71":1,"78":0,"77":0,"81":0,"83":0,"84":0,"82":0,"88":0,"85":0,"86":0,"87":0}	\N
9	Bui Thi Thom	thombt@bip.com.vn	1	\N	2015-07-01	$2y$12$zXqo43tggEsDmSxTUjbXxu6ZhSKTt86pKHYjW6W8vEzF1jqXLvGKS	glEnvw0e7z86PzeQr0Alu1DgUoVccqqwh1NPS2cce5IevYBINX7aDgOiLilF	2024-12-31 09:32:07	2024-12-31 17:14:39	\N	\N
25	Nguyen Minh Quang	quangnm@bip.com.vn	1	\N	2024-12-02	$2y$12$SS5G5mW.JqAqAj0aWqAA9ui5.eh/djHsoga3UkmnFT.GhNzcKimbC	FYKUl2gW53ItB7lVkH210oxvkXRYsQCKGlGKXDrxgCkfZLmd1PMsDEk4EaNW	2024-12-31 09:32:07	2025-01-20 17:02:22	{"1":0,"2":0,"3":0,"4":5,"5":5,"6":0,"30":0,"8":0,"7":0,"21":0,"20":0,"18":0,"10":0,"11":0,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":0,"9":0,"24":0,"25":0,"26":0,"27":0,"28":0,"29":0,"34":0,"33":0,"36":0,"32":0,"31":0,"35":0,"40":0,"38":0,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":0,"49":0,"62":0,"45":0,"47":0,"50":0,"60":0,"58":0,"54":0,"53":0,"52":0,"55":0,"57":0,"56":0,"61":0,"63":0,"59":0,"74":0,"73":0,"72":0,"66":0,"67":0,"68":0,"65":0,"64":0,"76":0,"75":5,"69":0,"70":0,"71":0,"78":0,"77":0}	\N
27	Tran Minh Hang	hangtm@bip.com.vn	1	\N	2024-05-02	$2y$12$1OFc4HtQPEw61SnOon5eP.maOM7LJin3HfOfR2LqP6m/oxD8w7/v2	3w6wFlBAMbGjxgfnxYISU0r0RIfDvtK0tekUHMhaLdeQkf3a7ghEFwUJVCST	2024-12-31 09:32:07	2024-12-31 17:02:48	\N	\N
5	Bui Hong Khanh	khanhbhk@bip.com.vn	1	\N	2007-11-07	$2y$12$.U4fDxb.hBuZyWEUruy17ePRbbldhEdWKy7SrBiis.g8kjAnZX.9W	CBFvffONHXYfsIV4gC97PCgfN5h1Icdi7gYZAA7SiX0McNryYDHC10ENg2Nf	2024-12-31 09:32:07	2024-12-31 17:05:37	\N	\N
11	Pham Long Quan	quanpl@bip.com.vn	1	\N	2018-06-11	$2y$12$sLc01T2OznqYXKqWf.Jpae41v1jqEPe9vyu73jIZapp1csdNLkXuu	ZI1uXt8aklgydmAEGqZ4ag4T6QMmY89glOeAIAUWKVBO9Y21EK21vj0GXb1p	2024-12-31 09:32:07	2024-12-31 17:05:19	\N	\N
18	Nguyen Anh Tuan	tuanna@bip.com.vn	1	\N	2024-09-04	$2y$12$FkI3gYSKDvZBehTvvaZ.5eHx3QM7lGpOimhub0YfeN5xTO5t2/D/m	7wcoEIdjDWTujundAiszXB8XBZDRZ3GBn9QOhOYFfhhv4MLXv54k4UJQ4u4N	2024-12-31 09:32:07	2025-01-02 08:52:20	\N	\N
26	Tran Phuc Hong	hongtp@bip.com.vn	1	\N	2025-01-06	$2y$12$gRslmhqk/0pPGQJ0WhQw0u/fI/A/WYGX7yVmm.tzUbp/hmug9PB7e	ta6a1dIgzFpcJot7eeVk1gnZlDsQ0LrazFvBJa5iXs29pGps7EIIkbsjtllr	2025-01-06 08:41:36	2025-01-07 10:46:08	\N	\N
13	Nguyen Hai Anh	anhnh@bip.com.vn	1	\N	2023-12-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	TDPbKEP5WUbqaMgcMSrsbNcgKpdBP6rKDQaGvpjmrX2J9W1HHthoSDTCVSh0	2024-12-31 09:32:07	2025-02-05 09:24:17	{"66":0,"67":1,"68":0,"65":0,"64":1,"69":0,"70":0,"71":0,"1":0,"2":0,"3":0,"4":0,"5":0,"79":0,"6":0,"30":0,"24":0,"25":1,"26":0,"27":1,"28":0,"29":0,"8":0,"7":1,"21":0,"20":0,"18":0,"10":0,"11":1,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":0,"9":0,"34":0,"80":0,"33":0,"36":0,"32":0,"31":1,"35":0,"40":0,"38":0,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":0,"49":0,"62":0,"45":1,"47":0,"50":0,"60":0,"58":0,"54":1,"53":1,"52":0,"55":0,"57":0,"56":0,"61":0,"63":0,"59":0,"88":0,"85":0,"86":0,"87":0,"81":0,"83":0,"84":0,"82":0,"74":0,"73":0,"72":0,"76":0,"75":0,"78":1,"77":0}	2025-02-05 09:24:17
29	Hoang Thi Ngoc Dung	dunghtn@bip.com.vn	1	\N	2024-11-04	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	JGjQGAPm0CFWbXdarGy9xnwYTnZ68CfHTQukX2zlmcYIJkkhSxMYCcGBhW95	2024-12-31 09:32:07	2024-12-31 09:32:07	\N	\N
16	Nguyen Tien Dung	dungnt@bip.com.vn	1	\N	2024-09-04	$2y$12$RHp/aY5bFCD3EYU/0dZtRuEXQl0ktPY49IzAd3phC6bNJz04HiFjm	VwTA1dTXnqBcQyHJ7eDFpn2zU6BzcxENeLLtbz68lCRX3oGPAGl4nvPmDXAo	2024-12-31 09:32:07	2025-01-03 08:28:16	\N	\N
19	Pham Van Dat	datpv@bip.com.vn	1	\N	2024-09-04	$2y$12$6BRPbTCFoQ5ecEUJ32pLQOpd6snTaM4uzlVW7xhatBWeVENVoKS1W	dTZjx5Rr8g5q0ocNTJ1kwrC49lFr4iR29AYMDgs0vXJ3OogURA00jSdqjUIP	2024-12-31 09:32:07	2024-12-31 17:03:42	\N	\N
7	Nguyen Thuong Minh	minhnt@bip.com.vn	1	\N	2014-08-18	$2y$12$5sJa8q3meWdAjSy0GBXmRehnSUtRj1fe47Ss0bWtAiHMB2TGWkgDa	8aCmazjminKk3kCilRpqa47gIIWcaTvc0flcNkdBUZTLZy61mcicA9R3d6mW	2024-12-31 09:32:07	2025-01-20 17:30:39	{"1":2,"2":0,"3":2,"4":0,"5":0,"79":0,"6":1,"30":0,"8":0,"7":0,"21":0,"20":0,"18":0,"10":5,"11":2,"19":0,"17":0,"15":2,"13":1,"14":1,"16":0,"22":0,"23":0,"12":0,"9":0,"24":0,"25":0,"26":1,"27":5,"28":0,"29":0,"34":0,"80":5,"33":0,"36":2,"32":0,"31":1,"35":0,"40":2,"38":3,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":2,"46":0,"51":0,"49":3,"62":0,"45":0,"47":0,"50":0,"60":0,"58":0,"54":0,"53":2,"52":3,"55":2,"57":0,"56":1,"61":0,"63":0,"59":0,"74":0,"73":0,"72":0,"66":5,"67":1,"68":0,"65":1,"64":5,"76":3,"75":5,"69":0,"70":0,"71":0,"78":5,"77":5,"81":0,"83":0,"84":0,"82":0}	\N
22	Nguyen Tuan Anh	anhnt@bip.com.vn	1	\N	2024-09-17	$2y$12$tjaQejAjIo0BzDbvkxhjfeXy9wldU3O6Iortr6E0CJcCNuAcsxhwe	QZpMOsL0vsN130Z6mjWJvAPSCtW7hjgYQH87Loen8SWAHrQzuRtJUMcT0TCV	2024-12-31 09:32:07	2025-01-21 09:05:24	{"1":0,"2":0,"3":0,"4":0,"5":0,"79":0,"6":0,"30":0,"8":0,"7":1,"21":0,"20":0,"18":0,"10":3,"11":1,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":0,"9":0,"24":0,"25":3,"26":0,"27":0,"28":0,"29":0,"34":0,"80":0,"33":2,"36":2,"32":0,"31":2,"35":0,"40":0,"38":1,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":0,"49":2,"62":0,"45":0,"47":0,"50":0,"60":0,"58":1,"54":2,"53":2,"52":2,"55":1,"57":0,"56":0,"61":0,"63":0,"59":0,"74":0,"73":0,"72":0,"66":0,"67":1,"68":0,"65":0,"64":0,"76":2,"75":0,"69":0,"70":0,"71":0,"78":1,"77":0,"81":0,"83":0,"84":0,"82":0,"88":0,"85":0,"86":0,"87":0}	\N
14	Tran Tuan Long	longtt@bip.com.vn	1	\N	2024-01-02	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	lbtbSgMsjJRpxO4NHTiwTdfspSlFzgcfvTbVSChW5cdTyzDoeo40pNCiLU4B	2024-12-31 09:32:07	2025-01-22 18:17:01	{"66":5,"67":5,"68":3,"65":5,"64":5,"69":5,"70":3,"71":5,"1":3,"2":2,"3":3,"4":1,"5":1,"79":1,"6":0,"30":0,"24":5,"25":5,"26":5,"27":5,"28":4,"29":5,"8":5,"7":5,"21":5,"20":5,"18":4,"10":5,"11":5,"19":5,"17":3,"15":5,"13":5,"14":5,"16":3,"22":1,"23":4,"12":5,"9":5,"34":5,"80":5,"33":5,"36":5,"32":5,"31":5,"35":4,"40":5,"38":5,"44":5,"42":1,"37":5,"41":4,"39":5,"43":1,"48":5,"46":5,"51":4,"49":5,"62":4,"45":5,"47":5,"50":3,"60":5,"58":5,"54":5,"53":5,"52":5,"55":5,"57":4,"56":4,"61":2,"63":4,"59":4,"88":5,"85":5,"86":4,"87":4,"81":4,"83":2,"84":2,"82":2,"74":2,"73":4,"72":5,"76":5,"75":5,"78":5,"77":5}	2025-01-22 18:17:01
999	Power User	test_pu@bip.com.vn	9	\N	2025-01-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	\N	2025-02-05 04:05:13	2025-02-05 04:05:13	\N	\N
15	Hoang Quang Linh	linhhq@bip.com.vn	1	\N	2024-04-15	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	EYfwPvSMs2uhpkPLVBIh2X4VDn15nSaxmHmOeqf0Q1sg6Xoyn0lq7OWq5PtF	2024-12-31 09:32:07	2025-02-03 08:54:28	{"66":0,"67":0,"68":0,"65":2,"64":0,"69":3,"70":0,"71":0,"1":0,"2":0,"3":0,"4":0,"5":0,"79":0,"6":1,"30":0,"24":0,"25":2,"26":2,"27":1,"28":0,"29":0,"8":0,"7":2,"21":0,"20":0,"18":1,"10":3,"11":3,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":3,"9":0,"34":0,"80":1,"33":3,"36":1,"32":0,"31":0,"35":0,"40":0,"38":3,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":1,"49":3,"62":0,"45":0,"47":0,"50":0,"60":0,"58":3,"54":1,"53":5,"52":5,"55":0,"57":2,"56":4,"61":0,"63":4,"59":0,"88":0,"85":0,"86":0,"87":0,"81":0,"83":0,"84":0,"82":0,"74":0,"73":0,"72":0,"76":5,"75":0,"78":0,"77":0}	2025-02-03 08:54:28
505	Nguyen Thi Ngoc Anh	anhntn@bip.com.vn	1	\N	2025-02-04	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	\N	2025-02-03 10:14:32	2025-02-03 10:14:32	\N	\N
20	Luu Thi Hai Yen	yenlth@bip.com.vn	1	\N	2024-08-12	$2y$12$oeck/lffYZOnHTigONSP7uPGRATNQwyV8ut2RuugaWAzPeInJ/W9y	yz5Q0zm3FiwvR20UAe5vqVfXjnfO9dJdB9X8EeCh9BSQZ53mjuT6EuypVPtS	2024-12-31 09:32:07	2025-01-21 09:04:36	{"1":0,"2":0,"3":0,"4":0,"5":0,"79":0,"6":0,"30":0,"8":0,"7":1,"21":0,"20":0,"18":0,"10":3,"11":1,"19":0,"17":0,"15":0,"13":0,"14":0,"16":0,"22":0,"23":0,"12":2,"9":0,"24":0,"25":2,"26":3,"27":1,"28":0,"29":0,"34":0,"80":1,"33":3,"36":0,"32":0,"31":2,"35":0,"40":1,"38":2,"44":0,"42":0,"37":0,"41":0,"39":0,"43":0,"48":0,"46":0,"51":0,"49":2,"62":0,"45":0,"47":0,"50":0,"60":0,"58":0,"54":1,"53":2,"52":2,"55":0,"57":2,"56":2,"61":0,"63":2,"59":0,"74":0,"73":1,"72":0,"66":0,"67":1,"68":0,"65":3,"64":3,"76":3,"75":1,"69":1,"70":0,"71":1,"78":1,"77":1,"81":0,"83":0,"84":0,"82":0,"88":0,"85":0,"86":0,"87":0}	\N
990	Admin	test_admin@bip.com.vn	0	\N	2025-01-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	zuAZ8zY10wJvPkLGswu2HaOUuZDQpcuQd39vHBvcES9Cu9fj7Dcz2EI81DzH	2025-02-05 04:05:13	2025-02-05 04:05:13	\N	\N
992	Mod	test_mod@bip.com.vn	2	\N	2025-01-01	$2y$12$0ODO2oyd0oLAfV/xPAhKfexoFsQqpGzRpq/rSAthESm35ghXDKqGW	05XshUuKjGqlJ4fAhhTnbwFmp1ibs55C4VM8Or6fdwnBMUl8Jr5LhrI5txPT	2025-02-05 04:05:13	2025-02-05 04:05:13	\N	\N
424	Nguyen Van Duc	ducnv@bip.com.vn	1	\N	2025-02-03	$2y$12$qW4.yIckqcEJ9joROLBkuOhcsGSUaz8dMp7IAkgHw3PdgX03er.ES	ahk5BcylsweY4WjG0JOPcdU4rsl9T5vNFePfmOfP3cEPuuDB3KwL80ZgGUtm	2025-02-03 10:14:32	2025-02-20 08:07:16	\N	\N
\.


--
-- Name: application_form_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_form_id_seq', 63, true);


--
-- Name: check_in_out_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.check_in_out_id_seq', 1829, true);


--
-- Name: days_off_by_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.days_off_by_schedule_id_seq', 6, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: leave_days_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.leave_days_id_seq', 55, true);


--
-- Name: leave_days_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.leave_days_log_id_seq', 76, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 38, true);


--
-- Name: overtime_form_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.overtime_form_id_seq', 14, true);


--
-- Name: project_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.project_users_id_seq', 19, true);


--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 6, true);


--
-- Name: skill_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.skill_category_id_seq', 16, true);


--
-- Name: skill_item_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.skill_item_id_seq', 88, true);


--
-- Name: team_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.team_users_id_seq', 24, true);


--
-- Name: teams_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.teams_id_seq', 7, true);


--
-- Name: user_skill_history_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_skill_history_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 10, true);


--
-- Name: application_form application_form_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_form
    ADD CONSTRAINT application_form_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: check_in_out check_in_out_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.check_in_out
    ADD CONSTRAINT check_in_out_pkey PRIMARY KEY (id);


--
-- Name: days_off_by_schedule days_off_by_schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.days_off_by_schedule
    ADD CONSTRAINT days_off_by_schedule_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: leave_days_log leave_days_log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days_log
    ADD CONSTRAINT leave_days_log_pkey PRIMARY KEY (id);


--
-- Name: leave_days leave_days_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days
    ADD CONSTRAINT leave_days_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: overtime_form overtime_form_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.overtime_form
    ADD CONSTRAINT overtime_form_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: project_users project_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_users
    ADD CONSTRAINT project_users_pkey PRIMARY KEY (id);


--
-- Name: project_users project_users_user_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_users
    ADD CONSTRAINT project_users_user_id_unique UNIQUE (user_id);


--
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- Name: projects projects_project_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_project_name_unique UNIQUE (project_name);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: skill_category skill_category_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_category
    ADD CONSTRAINT skill_category_code_unique UNIQUE (code);


--
-- Name: skill_category skill_category_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_category
    ADD CONSTRAINT skill_category_name_unique UNIQUE (name);


--
-- Name: skill_category skill_category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_category
    ADD CONSTRAINT skill_category_pkey PRIMARY KEY (id);


--
-- Name: skill_item skill_item_code_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_item
    ADD CONSTRAINT skill_item_code_unique UNIQUE (code);


--
-- Name: skill_item skill_item_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_item
    ADD CONSTRAINT skill_item_name_unique UNIQUE (name);


--
-- Name: skill_item skill_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_item
    ADD CONSTRAINT skill_item_pkey PRIMARY KEY (id);


--
-- Name: team_users team_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.team_users
    ADD CONSTRAINT team_users_pkey PRIMARY KEY (id);


--
-- Name: team_users team_users_user_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.team_users
    ADD CONSTRAINT team_users_user_id_unique UNIQUE (user_id);


--
-- Name: teams teams_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teams
    ADD CONSTRAINT teams_pkey PRIMARY KEY (id);


--
-- Name: teams teams_team_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.teams
    ADD CONSTRAINT teams_team_name_unique UNIQUE (team_name);


--
-- Name: user_skill_history user_skill_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_skill_history
    ADD CONSTRAINT user_skill_history_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: application_form application_form_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_form
    ADD CONSTRAINT application_form_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: check_in_out check_in_out_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.check_in_out
    ADD CONSTRAINT check_in_out_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: leave_days_log leave_days_log_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days_log
    ADD CONSTRAINT leave_days_log_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: leave_days leave_days_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_days
    ADD CONSTRAINT leave_days_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: overtime_form overtime_form_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.overtime_form
    ADD CONSTRAINT overtime_form_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: project_users project_users_project_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_users
    ADD CONSTRAINT project_users_project_id_foreign FOREIGN KEY (project_id) REFERENCES public.projects(id) ON DELETE CASCADE;


--
-- Name: project_users project_users_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.project_users
    ADD CONSTRAINT project_users_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: projects projects_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: skill_item skill_item_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.skill_item
    ADD CONSTRAINT skill_item_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.skill_category(id);


--
-- Name: team_users team_users_team_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.team_users
    ADD CONSTRAINT team_users_team_id_foreign FOREIGN KEY (team_id) REFERENCES public.teams(id) ON DELETE CASCADE;


--
-- Name: team_users team_users_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.team_users
    ADD CONSTRAINT team_users_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: user_skill_history user_skill_history_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_skill_history
    ADD CONSTRAINT user_skill_history_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

