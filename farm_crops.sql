PGDMP  ;                
    {         
   farm_crops    16.0    16.0 �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16398 
   farm_crops    DATABASE     �   CREATE DATABASE farm_crops WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE farm_crops;
                postgres    false            �            1259    16472    account    TABLE     �   CREATE TABLE public.account (
    account_id integer NOT NULL,
    username character varying(255),
    password character varying(255)
);
    DROP TABLE public.account;
       public         heap    postgres    false            �            1259    16471    account_account_id_seq    SEQUENCE     �   CREATE SEQUENCE public.account_account_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.account_account_id_seq;
       public          postgres    false    231            �           0    0    account_account_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.account_account_id_seq OWNED BY public.account.account_id;
          public          postgres    false    230            �            1259    16522 
   basic_info    TABLE     <  CREATE TABLE public.basic_info (
    basic_info_id integer NOT NULL,
    image character varying(255),
    name character varying(255),
    scientific_name character varying(255),
    plant_type_id integer,
    basic_description text,
    origin text,
    genus text,
    farming_id integer,
    usage_id integer
);
    DROP TABLE public.basic_info;
       public         heap    postgres    false            �            1259    16521    basic_info_basic_info_id_seq    SEQUENCE     �   CREATE SEQUENCE public.basic_info_basic_info_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.basic_info_basic_info_id_seq;
       public          postgres    false    243            �           0    0    basic_info_basic_info_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.basic_info_basic_info_id_seq OWNED BY public.basic_info.basic_info_id;
          public          postgres    false    242            �            1259    16573    basic_info_farming    TABLE     p   CREATE TABLE public.basic_info_farming (
    basic_info_id integer NOT NULL,
    farming_id integer NOT NULL
);
 &   DROP TABLE public.basic_info_farming;
       public         heap    postgres    false            �            1259    16578    basic_info_usage    TABLE     l   CREATE TABLE public.basic_info_usage (
    basic_info_id integer NOT NULL,
    usage_id integer NOT NULL
);
 $   DROP TABLE public.basic_info_usage;
       public         heap    postgres    false            �            1259    16481    contact    TABLE     �   CREATE TABLE public.contact (
    contact_id integer NOT NULL,
    contact_type character varying(255),
    contact_details character varying(255)
);
    DROP TABLE public.contact;
       public         heap    postgres    false            �            1259    16480    contact_contact_id_seq    SEQUENCE     �   CREATE SEQUENCE public.contact_contact_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.contact_contact_id_seq;
       public          postgres    false    233            �           0    0    contact_contact_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.contact_contact_id_seq OWNED BY public.contact.contact_id;
          public          postgres    false    232            �            1259    16553    crop_mapping    TABLE     i   CREATE TABLE public.crop_mapping (
    crop_id integer NOT NULL,
    mapping_info_id integer NOT NULL
);
     DROP TABLE public.crop_mapping;
       public         heap    postgres    false            �            1259    16433 	   crop_type    TABLE     p   CREATE TABLE public.crop_type (
    crop_type_id integer NOT NULL,
    crop_type_name character varying(255)
);
    DROP TABLE public.crop_type;
       public         heap    postgres    false            �            1259    16432    crop_type_crop_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.crop_type_crop_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.crop_type_crop_type_id_seq;
       public          postgres    false    221            �           0    0    crop_type_crop_type_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.crop_type_crop_type_id_seq OWNED BY public.crop_type.crop_type_id;
          public          postgres    false    220            �            1259    16447    farming    TABLE     �   CREATE TABLE public.farming (
    farming_id integer NOT NULL,
    farming_name character varying(255),
    farming_description text,
    farming_image character varying(255)
);
    DROP TABLE public.farming;
       public         heap    postgres    false            �            1259    16446    farming_farming_id_seq    SEQUENCE     �   CREATE SEQUENCE public.farming_farming_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.farming_farming_id_seq;
       public          postgres    false    225            �           0    0    farming_farming_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.farming_farming_id_seq OWNED BY public.farming.farming_id;
          public          postgres    false    224            �            1259    16411    follows    TABLE     �   CREATE TABLE public.follows (
    following_user_id integer,
    followed_user_id integer,
    created_at timestamp without time zone
);
    DROP TABLE public.follows;
       public         heap    postgres    false            �            1259    16465    location    TABLE     �   CREATE TABLE public.location (
    location_id integer NOT NULL,
    location_name character varying(255),
    longitude double precision,
    latitude double precision
);
    DROP TABLE public.location;
       public         heap    postgres    false            �            1259    16464    location_location_id_seq    SEQUENCE     �   CREATE SEQUENCE public.location_location_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.location_location_id_seq;
       public          postgres    false    229            �           0    0    location_location_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.location_location_id_seq OWNED BY public.location.location_id;
          public          postgres    false    228            �            1259    16540    mapping_info    TABLE     �   CREATE TABLE public.mapping_info (
    mapping_info_id integer NOT NULL,
    location_id integer,
    user_id integer,
    local_name character varying(255)
);
     DROP TABLE public.mapping_info;
       public         heap    postgres    false            �            1259    16539     mapping_info_mapping_info_id_seq    SEQUENCE     �   CREATE SEQUENCE public.mapping_info_mapping_info_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.mapping_info_mapping_info_id_seq;
       public          postgres    false    247            �           0    0     mapping_info_mapping_info_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.mapping_info_mapping_info_id_seq OWNED BY public.mapping_info.mapping_info_id;
          public          postgres    false    246            �            1259    16440 
   plant_type    TABLE     s   CREATE TABLE public.plant_type (
    plant_type_id integer NOT NULL,
    plant_type_name character varying(255)
);
    DROP TABLE public.plant_type;
       public         heap    postgres    false            �            1259    16439    plant_type_plant_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.plant_type_plant_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.plant_type_plant_type_id_seq;
       public          postgres    false    223            �           0    0    plant_type_plant_type_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.plant_type_plant_type_id_seq OWNED BY public.plant_type.plant_type_id;
          public          postgres    false    222            �            1259    16424    posts    TABLE     �   CREATE TABLE public.posts (
    id integer NOT NULL,
    title character varying(255),
    body text,
    user_id integer,
    status character varying(255),
    created_at timestamp without time zone
);
    DROP TABLE public.posts;
       public         heap    postgres    false            �            1259    16423    posts_id_seq    SEQUENCE     �   CREATE SEQUENCE public.posts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.posts_id_seq;
       public          postgres    false    219            �           0    0    posts_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;
          public          postgres    false    218            �            1259    16497 	   practices    TABLE     �   CREATE TABLE public.practices (
    practices_id integer NOT NULL,
    practices_name character varying(255),
    practices_description text,
    practices_image character varying(255)
);
    DROP TABLE public.practices;
       public         heap    postgres    false            �            1259    16496    practices_practices_id_seq    SEQUENCE     �   CREATE SEQUENCE public.practices_practices_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.practices_practices_id_seq;
       public          postgres    false    237            �           0    0    practices_practices_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.practices_practices_id_seq OWNED BY public.practices.practices_id;
          public          postgres    false    236            �            1259    16506    ritual    TABLE     �   CREATE TABLE public.ritual (
    ritual_id integer NOT NULL,
    ritual_name character varying(255),
    ritual_description text,
    ritual_image character varying(255)
);
    DROP TABLE public.ritual;
       public         heap    postgres    false            �            1259    16505    ritual_ritual_id_seq    SEQUENCE     �   CREATE SEQUENCE public.ritual_ritual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.ritual_ritual_id_seq;
       public          postgres    false    239            �           0    0    ritual_ritual_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.ritual_ritual_id_seq OWNED BY public.ritual.ritual_id;
          public          postgres    false    238            �            1259    16547    traditional_crop    TABLE     x   CREATE TABLE public.traditional_crop (
    crop_id integer NOT NULL,
    basic_info_id integer,
    tribe_id integer
);
 $   DROP TABLE public.traditional_crop;
       public         heap    postgres    false            �            1259    16546    traditional_crop_crop_id_seq    SEQUENCE     �   CREATE SEQUENCE public.traditional_crop_crop_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.traditional_crop_crop_id_seq;
       public          postgres    false    249            �           0    0    traditional_crop_crop_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.traditional_crop_crop_id_seq OWNED BY public.traditional_crop.crop_id;
          public          postgres    false    248            �            1259    16515    tribe    TABLE     �   CREATE TABLE public.tribe (
    tribe_id integer NOT NULL,
    tribe_name character varying(255),
    practices_id integer,
    ritual_id integer,
    tribe_image character varying(255)
);
    DROP TABLE public.tribe;
       public         heap    postgres    false            �            1259    16558 
   tribe_crop    TABLE     `   CREATE TABLE public.tribe_crop (
    crop_id integer NOT NULL,
    tribe_id integer NOT NULL
);
    DROP TABLE public.tribe_crop;
       public         heap    postgres    false            �            1259    16563    tribe_practices    TABLE     j   CREATE TABLE public.tribe_practices (
    tribe_id integer NOT NULL,
    practices_id integer NOT NULL
);
 #   DROP TABLE public.tribe_practices;
       public         heap    postgres    false            �            1259    16568    tribe_ritual    TABLE     d   CREATE TABLE public.tribe_ritual (
    tribe_id integer NOT NULL,
    ritual_id integer NOT NULL
);
     DROP TABLE public.tribe_ritual;
       public         heap    postgres    false            �            1259    16514    tribe_tribe_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tribe_tribe_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tribe_tribe_id_seq;
       public          postgres    false    241            �           0    0    tribe_tribe_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tribe_tribe_id_seq OWNED BY public.tribe.tribe_id;
          public          postgres    false    240            �            1259    16456 
   usage_info    TABLE     �   CREATE TABLE public.usage_info (
    usage_id integer NOT NULL,
    usage_name character varying(255),
    usage_description text,
    usage_image character varying(255),
    usage_example text
);
    DROP TABLE public.usage_info;
       public         heap    postgres    false            �            1259    16455    usage_info_usage_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usage_info_usage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.usage_info_usage_id_seq;
       public          postgres    false    227            �           0    0    usage_info_usage_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.usage_info_usage_id_seq OWNED BY public.usage_info.usage_id;
          public          postgres    false    226            �            1259    16531    user    TABLE     �   CREATE TABLE public."user" (
    user_id integer NOT NULL,
    account_id integer,
    first_name character varying(255),
    last_name character varying(255)
);
    DROP TABLE public."user";
       public         heap    postgres    false            �            1259    16490 	   user_type    TABLE     p   CREATE TABLE public.user_type (
    user_type_id integer NOT NULL,
    user_type_name character varying(255)
);
    DROP TABLE public.user_type;
       public         heap    postgres    false            �            1259    16489    user_type_user_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_type_user_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.user_type_user_type_id_seq;
       public          postgres    false    235            �           0    0    user_type_user_type_id_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.user_type_user_type_id_seq OWNED BY public.user_type.user_type_id;
          public          postgres    false    234            �            1259    16530    user_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.user_user_id_seq;
       public          postgres    false    245            �           0    0    user_user_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.user_user_id_seq OWNED BY public."user".user_id;
          public          postgres    false    244            �            1259    16415    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(255),
    role character varying(255),
    created_at timestamp without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16414    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    217            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    216            �           2604    16475    account account_id    DEFAULT     x   ALTER TABLE ONLY public.account ALTER COLUMN account_id SET DEFAULT nextval('public.account_account_id_seq'::regclass);
 A   ALTER TABLE public.account ALTER COLUMN account_id DROP DEFAULT;
       public          postgres    false    230    231    231            �           2604    16525    basic_info basic_info_id    DEFAULT     �   ALTER TABLE ONLY public.basic_info ALTER COLUMN basic_info_id SET DEFAULT nextval('public.basic_info_basic_info_id_seq'::regclass);
 G   ALTER TABLE public.basic_info ALTER COLUMN basic_info_id DROP DEFAULT;
       public          postgres    false    242    243    243            �           2604    16484    contact contact_id    DEFAULT     x   ALTER TABLE ONLY public.contact ALTER COLUMN contact_id SET DEFAULT nextval('public.contact_contact_id_seq'::regclass);
 A   ALTER TABLE public.contact ALTER COLUMN contact_id DROP DEFAULT;
       public          postgres    false    233    232    233            �           2604    16436    crop_type crop_type_id    DEFAULT     �   ALTER TABLE ONLY public.crop_type ALTER COLUMN crop_type_id SET DEFAULT nextval('public.crop_type_crop_type_id_seq'::regclass);
 E   ALTER TABLE public.crop_type ALTER COLUMN crop_type_id DROP DEFAULT;
       public          postgres    false    221    220    221            �           2604    16450    farming farming_id    DEFAULT     x   ALTER TABLE ONLY public.farming ALTER COLUMN farming_id SET DEFAULT nextval('public.farming_farming_id_seq'::regclass);
 A   ALTER TABLE public.farming ALTER COLUMN farming_id DROP DEFAULT;
       public          postgres    false    224    225    225            �           2604    16468    location location_id    DEFAULT     |   ALTER TABLE ONLY public.location ALTER COLUMN location_id SET DEFAULT nextval('public.location_location_id_seq'::regclass);
 C   ALTER TABLE public.location ALTER COLUMN location_id DROP DEFAULT;
       public          postgres    false    229    228    229            �           2604    16543    mapping_info mapping_info_id    DEFAULT     �   ALTER TABLE ONLY public.mapping_info ALTER COLUMN mapping_info_id SET DEFAULT nextval('public.mapping_info_mapping_info_id_seq'::regclass);
 K   ALTER TABLE public.mapping_info ALTER COLUMN mapping_info_id DROP DEFAULT;
       public          postgres    false    247    246    247            �           2604    16443    plant_type plant_type_id    DEFAULT     �   ALTER TABLE ONLY public.plant_type ALTER COLUMN plant_type_id SET DEFAULT nextval('public.plant_type_plant_type_id_seq'::regclass);
 G   ALTER TABLE public.plant_type ALTER COLUMN plant_type_id DROP DEFAULT;
       public          postgres    false    223    222    223            �           2604    16427    posts id    DEFAULT     d   ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);
 7   ALTER TABLE public.posts ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    219    219            �           2604    16500    practices practices_id    DEFAULT     �   ALTER TABLE ONLY public.practices ALTER COLUMN practices_id SET DEFAULT nextval('public.practices_practices_id_seq'::regclass);
 E   ALTER TABLE public.practices ALTER COLUMN practices_id DROP DEFAULT;
       public          postgres    false    236    237    237            �           2604    16509    ritual ritual_id    DEFAULT     t   ALTER TABLE ONLY public.ritual ALTER COLUMN ritual_id SET DEFAULT nextval('public.ritual_ritual_id_seq'::regclass);
 ?   ALTER TABLE public.ritual ALTER COLUMN ritual_id DROP DEFAULT;
       public          postgres    false    238    239    239            �           2604    16550    traditional_crop crop_id    DEFAULT     �   ALTER TABLE ONLY public.traditional_crop ALTER COLUMN crop_id SET DEFAULT nextval('public.traditional_crop_crop_id_seq'::regclass);
 G   ALTER TABLE public.traditional_crop ALTER COLUMN crop_id DROP DEFAULT;
       public          postgres    false    248    249    249            �           2604    16518    tribe tribe_id    DEFAULT     p   ALTER TABLE ONLY public.tribe ALTER COLUMN tribe_id SET DEFAULT nextval('public.tribe_tribe_id_seq'::regclass);
 =   ALTER TABLE public.tribe ALTER COLUMN tribe_id DROP DEFAULT;
       public          postgres    false    241    240    241            �           2604    16459    usage_info usage_id    DEFAULT     z   ALTER TABLE ONLY public.usage_info ALTER COLUMN usage_id SET DEFAULT nextval('public.usage_info_usage_id_seq'::regclass);
 B   ALTER TABLE public.usage_info ALTER COLUMN usage_id DROP DEFAULT;
       public          postgres    false    227    226    227            �           2604    16534    user user_id    DEFAULT     n   ALTER TABLE ONLY public."user" ALTER COLUMN user_id SET DEFAULT nextval('public.user_user_id_seq'::regclass);
 =   ALTER TABLE public."user" ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    245    244    245            �           2604    16493    user_type user_type_id    DEFAULT     �   ALTER TABLE ONLY public.user_type ALTER COLUMN user_type_id SET DEFAULT nextval('public.user_type_user_type_id_seq'::regclass);
 E   ALTER TABLE public.user_type ALTER COLUMN user_type_id DROP DEFAULT;
       public          postgres    false    235    234    235            �           2604    16418    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    217    217            }          0    16472    account 
   TABLE DATA           A   COPY public.account (account_id, username, password) FROM stdin;
    public          postgres    false    231   ��       �          0    16522 
   basic_info 
   TABLE DATA           �   COPY public.basic_info (basic_info_id, image, name, scientific_name, plant_type_id, basic_description, origin, genus, farming_id, usage_id) FROM stdin;
    public          postgres    false    243   ��       �          0    16573    basic_info_farming 
   TABLE DATA           G   COPY public.basic_info_farming (basic_info_id, farming_id) FROM stdin;
    public          postgres    false    254   ��       �          0    16578    basic_info_usage 
   TABLE DATA           C   COPY public.basic_info_usage (basic_info_id, usage_id) FROM stdin;
    public          postgres    false    255   ��                 0    16481    contact 
   TABLE DATA           L   COPY public.contact (contact_id, contact_type, contact_details) FROM stdin;
    public          postgres    false    233   ��       �          0    16553    crop_mapping 
   TABLE DATA           @   COPY public.crop_mapping (crop_id, mapping_info_id) FROM stdin;
    public          postgres    false    250   �       s          0    16433 	   crop_type 
   TABLE DATA           A   COPY public.crop_type (crop_type_id, crop_type_name) FROM stdin;
    public          postgres    false    221   *�       w          0    16447    farming 
   TABLE DATA           _   COPY public.farming (farming_id, farming_name, farming_description, farming_image) FROM stdin;
    public          postgres    false    225   G�       m          0    16411    follows 
   TABLE DATA           R   COPY public.follows (following_user_id, followed_user_id, created_at) FROM stdin;
    public          postgres    false    215   ?�       {          0    16465    location 
   TABLE DATA           S   COPY public.location (location_id, location_name, longitude, latitude) FROM stdin;
    public          postgres    false    229   \�       �          0    16540    mapping_info 
   TABLE DATA           Y   COPY public.mapping_info (mapping_info_id, location_id, user_id, local_name) FROM stdin;
    public          postgres    false    247   y�       u          0    16440 
   plant_type 
   TABLE DATA           D   COPY public.plant_type (plant_type_id, plant_type_name) FROM stdin;
    public          postgres    false    223   ��       q          0    16424    posts 
   TABLE DATA           M   COPY public.posts (id, title, body, user_id, status, created_at) FROM stdin;
    public          postgres    false    219   ��       �          0    16497 	   practices 
   TABLE DATA           i   COPY public.practices (practices_id, practices_name, practices_description, practices_image) FROM stdin;
    public          postgres    false    237   ��       �          0    16506    ritual 
   TABLE DATA           Z   COPY public.ritual (ritual_id, ritual_name, ritual_description, ritual_image) FROM stdin;
    public          postgres    false    239   ^�       �          0    16547    traditional_crop 
   TABLE DATA           L   COPY public.traditional_crop (crop_id, basic_info_id, tribe_id) FROM stdin;
    public          postgres    false    249   (�       �          0    16515    tribe 
   TABLE DATA           [   COPY public.tribe (tribe_id, tribe_name, practices_id, ritual_id, tribe_image) FROM stdin;
    public          postgres    false    241   L�       �          0    16558 
   tribe_crop 
   TABLE DATA           7   COPY public.tribe_crop (crop_id, tribe_id) FROM stdin;
    public          postgres    false    251   ��       �          0    16563    tribe_practices 
   TABLE DATA           A   COPY public.tribe_practices (tribe_id, practices_id) FROM stdin;
    public          postgres    false    252   ��       �          0    16568    tribe_ritual 
   TABLE DATA           ;   COPY public.tribe_ritual (tribe_id, ritual_id) FROM stdin;
    public          postgres    false    253   �       y          0    16456 
   usage_info 
   TABLE DATA           i   COPY public.usage_info (usage_id, usage_name, usage_description, usage_image, usage_example) FROM stdin;
    public          postgres    false    227   *�       �          0    16531    user 
   TABLE DATA           L   COPY public."user" (user_id, account_id, first_name, last_name) FROM stdin;
    public          postgres    false    245   ��       �          0    16490 	   user_type 
   TABLE DATA           A   COPY public.user_type (user_type_id, user_type_name) FROM stdin;
    public          postgres    false    235   ��       o          0    16415    users 
   TABLE DATA           ?   COPY public.users (id, username, role, created_at) FROM stdin;
    public          postgres    false    217   ��       �           0    0    account_account_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.account_account_id_seq', 1, false);
          public          postgres    false    230            �           0    0    basic_info_basic_info_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.basic_info_basic_info_id_seq', 1, false);
          public          postgres    false    242            �           0    0    contact_contact_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.contact_contact_id_seq', 1, false);
          public          postgres    false    232            �           0    0    crop_type_crop_type_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.crop_type_crop_type_id_seq', 1, false);
          public          postgres    false    220            �           0    0    farming_farming_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.farming_farming_id_seq', 1, false);
          public          postgres    false    224            �           0    0    location_location_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.location_location_id_seq', 1, false);
          public          postgres    false    228            �           0    0     mapping_info_mapping_info_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.mapping_info_mapping_info_id_seq', 1, false);
          public          postgres    false    246            �           0    0    plant_type_plant_type_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.plant_type_plant_type_id_seq', 1, true);
          public          postgres    false    222            �           0    0    posts_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.posts_id_seq', 1, false);
          public          postgres    false    218            �           0    0    practices_practices_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.practices_practices_id_seq', 1, false);
          public          postgres    false    236            �           0    0    ritual_ritual_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.ritual_ritual_id_seq', 1, false);
          public          postgres    false    238            �           0    0    traditional_crop_crop_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.traditional_crop_crop_id_seq', 1, false);
          public          postgres    false    248            �           0    0    tribe_tribe_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tribe_tribe_id_seq', 1, false);
          public          postgres    false    240            �           0    0    usage_info_usage_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.usage_info_usage_id_seq', 1, false);
          public          postgres    false    226            �           0    0    user_type_user_type_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.user_type_user_type_id_seq', 1, false);
          public          postgres    false    234            �           0    0    user_user_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.user_user_id_seq', 1, false);
          public          postgres    false    244            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    216            �           2606    16479    account account_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.account
    ADD CONSTRAINT account_pkey PRIMARY KEY (account_id);
 >   ALTER TABLE ONLY public.account DROP CONSTRAINT account_pkey;
       public            postgres    false    231            �           2606    16577 *   basic_info_farming basic_info_farming_pkey 
   CONSTRAINT        ALTER TABLE ONLY public.basic_info_farming
    ADD CONSTRAINT basic_info_farming_pkey PRIMARY KEY (basic_info_id, farming_id);
 T   ALTER TABLE ONLY public.basic_info_farming DROP CONSTRAINT basic_info_farming_pkey;
       public            postgres    false    254    254            �           2606    16529    basic_info basic_info_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.basic_info
    ADD CONSTRAINT basic_info_pkey PRIMARY KEY (basic_info_id);
 D   ALTER TABLE ONLY public.basic_info DROP CONSTRAINT basic_info_pkey;
       public            postgres    false    243            �           2606    16582 &   basic_info_usage basic_info_usage_pkey 
   CONSTRAINT     y   ALTER TABLE ONLY public.basic_info_usage
    ADD CONSTRAINT basic_info_usage_pkey PRIMARY KEY (basic_info_id, usage_id);
 P   ALTER TABLE ONLY public.basic_info_usage DROP CONSTRAINT basic_info_usage_pkey;
       public            postgres    false    255    255            �           2606    16488    contact contact_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.contact
    ADD CONSTRAINT contact_pkey PRIMARY KEY (contact_id);
 >   ALTER TABLE ONLY public.contact DROP CONSTRAINT contact_pkey;
       public            postgres    false    233            �           2606    16557    crop_mapping crop_mapping_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.crop_mapping
    ADD CONSTRAINT crop_mapping_pkey PRIMARY KEY (crop_id, mapping_info_id);
 H   ALTER TABLE ONLY public.crop_mapping DROP CONSTRAINT crop_mapping_pkey;
       public            postgres    false    250    250            �           2606    16438    crop_type crop_type_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.crop_type
    ADD CONSTRAINT crop_type_pkey PRIMARY KEY (crop_type_id);
 B   ALTER TABLE ONLY public.crop_type DROP CONSTRAINT crop_type_pkey;
       public            postgres    false    221            �           2606    16454    farming farming_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.farming
    ADD CONSTRAINT farming_pkey PRIMARY KEY (farming_id);
 >   ALTER TABLE ONLY public.farming DROP CONSTRAINT farming_pkey;
       public            postgres    false    225            �           2606    16470    location location_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.location
    ADD CONSTRAINT location_pkey PRIMARY KEY (location_id);
 @   ALTER TABLE ONLY public.location DROP CONSTRAINT location_pkey;
       public            postgres    false    229            �           2606    16545    mapping_info mapping_info_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.mapping_info
    ADD CONSTRAINT mapping_info_pkey PRIMARY KEY (mapping_info_id);
 H   ALTER TABLE ONLY public.mapping_info DROP CONSTRAINT mapping_info_pkey;
       public            postgres    false    247            �           2606    16445    plant_type plant_type_pkey 
   CONSTRAINT     c   ALTER TABLE ONLY public.plant_type
    ADD CONSTRAINT plant_type_pkey PRIMARY KEY (plant_type_id);
 D   ALTER TABLE ONLY public.plant_type DROP CONSTRAINT plant_type_pkey;
       public            postgres    false    223            �           2606    16431    posts posts_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.posts DROP CONSTRAINT posts_pkey;
       public            postgres    false    219            �           2606    16504    practices practices_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.practices
    ADD CONSTRAINT practices_pkey PRIMARY KEY (practices_id);
 B   ALTER TABLE ONLY public.practices DROP CONSTRAINT practices_pkey;
       public            postgres    false    237            �           2606    16513    ritual ritual_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.ritual
    ADD CONSTRAINT ritual_pkey PRIMARY KEY (ritual_id);
 <   ALTER TABLE ONLY public.ritual DROP CONSTRAINT ritual_pkey;
       public            postgres    false    239            �           2606    16552 &   traditional_crop traditional_crop_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.traditional_crop
    ADD CONSTRAINT traditional_crop_pkey PRIMARY KEY (crop_id);
 P   ALTER TABLE ONLY public.traditional_crop DROP CONSTRAINT traditional_crop_pkey;
       public            postgres    false    249            �           2606    16562    tribe_crop tribe_crop_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.tribe_crop
    ADD CONSTRAINT tribe_crop_pkey PRIMARY KEY (crop_id, tribe_id);
 D   ALTER TABLE ONLY public.tribe_crop DROP CONSTRAINT tribe_crop_pkey;
       public            postgres    false    251    251            �           2606    16520    tribe tribe_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.tribe
    ADD CONSTRAINT tribe_pkey PRIMARY KEY (tribe_id);
 :   ALTER TABLE ONLY public.tribe DROP CONSTRAINT tribe_pkey;
       public            postgres    false    241            �           2606    16567 $   tribe_practices tribe_practices_pkey 
   CONSTRAINT     v   ALTER TABLE ONLY public.tribe_practices
    ADD CONSTRAINT tribe_practices_pkey PRIMARY KEY (tribe_id, practices_id);
 N   ALTER TABLE ONLY public.tribe_practices DROP CONSTRAINT tribe_practices_pkey;
       public            postgres    false    252    252            �           2606    16572    tribe_ritual tribe_ritual_pkey 
   CONSTRAINT     m   ALTER TABLE ONLY public.tribe_ritual
    ADD CONSTRAINT tribe_ritual_pkey PRIMARY KEY (tribe_id, ritual_id);
 H   ALTER TABLE ONLY public.tribe_ritual DROP CONSTRAINT tribe_ritual_pkey;
       public            postgres    false    253    253            �           2606    16463    usage_info usage_info_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.usage_info
    ADD CONSTRAINT usage_info_pkey PRIMARY KEY (usage_id);
 D   ALTER TABLE ONLY public.usage_info DROP CONSTRAINT usage_info_pkey;
       public            postgres    false    227            �           2606    16538    user user_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (user_id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            postgres    false    245            �           2606    16495    user_type user_type_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.user_type
    ADD CONSTRAINT user_type_pkey PRIMARY KEY (user_type_id);
 B   ALTER TABLE ONLY public.user_type DROP CONSTRAINT user_type_pkey;
       public            postgres    false    235            �           2606    16422    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217            �           2606    16688 8   basic_info_farming basic_info_farming_basic_info_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info_farming
    ADD CONSTRAINT basic_info_farming_basic_info_id_fkey FOREIGN KEY (basic_info_id) REFERENCES public.basic_info(basic_info_id);
 b   ALTER TABLE ONLY public.basic_info_farming DROP CONSTRAINT basic_info_farming_basic_info_id_fkey;
       public          postgres    false    4786    254    243            �           2606    16693 5   basic_info_farming basic_info_farming_farming_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info_farming
    ADD CONSTRAINT basic_info_farming_farming_id_fkey FOREIGN KEY (farming_id) REFERENCES public.farming(farming_id);
 _   ALTER TABLE ONLY public.basic_info_farming DROP CONSTRAINT basic_info_farming_farming_id_fkey;
       public          postgres    false    254    225    4768            �           2606    16613 %   basic_info basic_info_farming_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info
    ADD CONSTRAINT basic_info_farming_id_fkey FOREIGN KEY (farming_id) REFERENCES public.farming(farming_id);
 O   ALTER TABLE ONLY public.basic_info DROP CONSTRAINT basic_info_farming_id_fkey;
       public          postgres    false    4768    243    225            �           2606    16608 (   basic_info basic_info_plant_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info
    ADD CONSTRAINT basic_info_plant_type_id_fkey FOREIGN KEY (plant_type_id) REFERENCES public.plant_type(plant_type_id);
 R   ALTER TABLE ONLY public.basic_info DROP CONSTRAINT basic_info_plant_type_id_fkey;
       public          postgres    false    4766    243    223            �           2606    16698 4   basic_info_usage basic_info_usage_basic_info_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info_usage
    ADD CONSTRAINT basic_info_usage_basic_info_id_fkey FOREIGN KEY (basic_info_id) REFERENCES public.basic_info(basic_info_id);
 ^   ALTER TABLE ONLY public.basic_info_usage DROP CONSTRAINT basic_info_usage_basic_info_id_fkey;
       public          postgres    false    243    4786    255            �           2606    16618 #   basic_info basic_info_usage_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info
    ADD CONSTRAINT basic_info_usage_id_fkey FOREIGN KEY (usage_id) REFERENCES public.usage_info(usage_id);
 M   ALTER TABLE ONLY public.basic_info DROP CONSTRAINT basic_info_usage_id_fkey;
       public          postgres    false    243    4770    227            �           2606    16703 /   basic_info_usage basic_info_usage_usage_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.basic_info_usage
    ADD CONSTRAINT basic_info_usage_usage_id_fkey FOREIGN KEY (usage_id) REFERENCES public.usage_info(usage_id);
 Y   ALTER TABLE ONLY public.basic_info_usage DROP CONSTRAINT basic_info_usage_usage_id_fkey;
       public          postgres    false    255    227    4770            �           2606    16648 &   crop_mapping crop_mapping_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop_mapping
    ADD CONSTRAINT crop_mapping_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.traditional_crop(crop_id);
 P   ALTER TABLE ONLY public.crop_mapping DROP CONSTRAINT crop_mapping_crop_id_fkey;
       public          postgres    false    249    4792    250            �           2606    16653 .   crop_mapping crop_mapping_mapping_info_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop_mapping
    ADD CONSTRAINT crop_mapping_mapping_info_id_fkey FOREIGN KEY (mapping_info_id) REFERENCES public.mapping_info(mapping_info_id);
 X   ALTER TABLE ONLY public.crop_mapping DROP CONSTRAINT crop_mapping_mapping_info_id_fkey;
       public          postgres    false    4790    250    247            �           2606    16593 %   follows follows_followed_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.follows
    ADD CONSTRAINT follows_followed_user_id_fkey FOREIGN KEY (followed_user_id) REFERENCES public.users(id);
 O   ALTER TABLE ONLY public.follows DROP CONSTRAINT follows_followed_user_id_fkey;
       public          postgres    false    217    4760    215            �           2606    16588 &   follows follows_following_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.follows
    ADD CONSTRAINT follows_following_user_id_fkey FOREIGN KEY (following_user_id) REFERENCES public.users(id);
 P   ALTER TABLE ONLY public.follows DROP CONSTRAINT follows_following_user_id_fkey;
       public          postgres    false    4760    217    215            �           2606    16628 *   mapping_info mapping_info_location_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.mapping_info
    ADD CONSTRAINT mapping_info_location_id_fkey FOREIGN KEY (location_id) REFERENCES public.location(location_id);
 T   ALTER TABLE ONLY public.mapping_info DROP CONSTRAINT mapping_info_location_id_fkey;
       public          postgres    false    229    247    4772            �           2606    16633 &   mapping_info mapping_info_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.mapping_info
    ADD CONSTRAINT mapping_info_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(user_id);
 P   ALTER TABLE ONLY public.mapping_info DROP CONSTRAINT mapping_info_user_id_fkey;
       public          postgres    false    247    245    4788            �           2606    16583    posts posts_user_id_fkey    FK CONSTRAINT     w   ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id);
 B   ALTER TABLE ONLY public.posts DROP CONSTRAINT posts_user_id_fkey;
       public          postgres    false    4760    217    219            �           2606    16638 4   traditional_crop traditional_crop_basic_info_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.traditional_crop
    ADD CONSTRAINT traditional_crop_basic_info_id_fkey FOREIGN KEY (basic_info_id) REFERENCES public.basic_info(basic_info_id);
 ^   ALTER TABLE ONLY public.traditional_crop DROP CONSTRAINT traditional_crop_basic_info_id_fkey;
       public          postgres    false    243    249    4786            �           2606    16643 /   traditional_crop traditional_crop_tribe_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.traditional_crop
    ADD CONSTRAINT traditional_crop_tribe_id_fkey FOREIGN KEY (tribe_id) REFERENCES public.tribe(tribe_id);
 Y   ALTER TABLE ONLY public.traditional_crop DROP CONSTRAINT traditional_crop_tribe_id_fkey;
       public          postgres    false    249    241    4784            �           2606    16658 "   tribe_crop tribe_crop_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_crop
    ADD CONSTRAINT tribe_crop_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.traditional_crop(crop_id);
 L   ALTER TABLE ONLY public.tribe_crop DROP CONSTRAINT tribe_crop_crop_id_fkey;
       public          postgres    false    4792    249    251            �           2606    16663 #   tribe_crop tribe_crop_tribe_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_crop
    ADD CONSTRAINT tribe_crop_tribe_id_fkey FOREIGN KEY (tribe_id) REFERENCES public.tribe(tribe_id);
 M   ALTER TABLE ONLY public.tribe_crop DROP CONSTRAINT tribe_crop_tribe_id_fkey;
       public          postgres    false    251    241    4784            �           2606    16598    tribe tribe_practices_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe
    ADD CONSTRAINT tribe_practices_id_fkey FOREIGN KEY (practices_id) REFERENCES public.practices(practices_id);
 G   ALTER TABLE ONLY public.tribe DROP CONSTRAINT tribe_practices_id_fkey;
       public          postgres    false    241    237    4780            �           2606    16673 1   tribe_practices tribe_practices_practices_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_practices
    ADD CONSTRAINT tribe_practices_practices_id_fkey FOREIGN KEY (practices_id) REFERENCES public.practices(practices_id);
 [   ALTER TABLE ONLY public.tribe_practices DROP CONSTRAINT tribe_practices_practices_id_fkey;
       public          postgres    false    237    252    4780            �           2606    16668 -   tribe_practices tribe_practices_tribe_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_practices
    ADD CONSTRAINT tribe_practices_tribe_id_fkey FOREIGN KEY (tribe_id) REFERENCES public.tribe(tribe_id);
 W   ALTER TABLE ONLY public.tribe_practices DROP CONSTRAINT tribe_practices_tribe_id_fkey;
       public          postgres    false    241    4784    252            �           2606    16603    tribe tribe_ritual_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe
    ADD CONSTRAINT tribe_ritual_id_fkey FOREIGN KEY (ritual_id) REFERENCES public.ritual(ritual_id);
 D   ALTER TABLE ONLY public.tribe DROP CONSTRAINT tribe_ritual_id_fkey;
       public          postgres    false    239    4782    241            �           2606    16683 (   tribe_ritual tribe_ritual_ritual_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_ritual
    ADD CONSTRAINT tribe_ritual_ritual_id_fkey FOREIGN KEY (ritual_id) REFERENCES public.ritual(ritual_id);
 R   ALTER TABLE ONLY public.tribe_ritual DROP CONSTRAINT tribe_ritual_ritual_id_fkey;
       public          postgres    false    239    253    4782            �           2606    16678 '   tribe_ritual tribe_ritual_tribe_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tribe_ritual
    ADD CONSTRAINT tribe_ritual_tribe_id_fkey FOREIGN KEY (tribe_id) REFERENCES public.tribe(tribe_id);
 Q   ALTER TABLE ONLY public.tribe_ritual DROP CONSTRAINT tribe_ritual_tribe_id_fkey;
       public          postgres    false    253    241    4784            �           2606    16623    user user_account_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_account_id_fkey FOREIGN KEY (account_id) REFERENCES public.account(account_id);
 E   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_account_id_fkey;
       public          postgres    false    245    231    4774            }      x������ � �      �   �  x�=Q���0=;_1,4�$N�NR�`Jʖl��B/�-۳�5�4���߱�頑޼��)�Z��Y��S��q��7ʷqIݪo�i���i����6�fK�K���v����*0�5�N�F�KG��_���x5X�Xn�u�J�U~L���u��O߲��uP����N����Y}�Ʒ���>ɞy�m7�W�&�WQ���m�E@gK�1�:�R�V������G��N�
�PVֲwT�r;� ��-\�g�,+�[i���u�`/r-=吂'�J�(�/�n�Q�XB�R(����Χ���	��:�Y��J�P9iO#�����d�a&'��HX67`�f)hRw��{ �6�/���	6����.� �Pb��d'-A�k'��H
�g-��n�>����1R�^L�M�2�����}��Aߎ�C�iᥗ��Z��I�C��qt�6x��d�7��fog���      �      x������ � �      �      x������ � �            x������ � �      �      x������ � �      s      x������ � �      w   �   x�UN�N�0�ۧ�p�ݵ*������$�I*;����W�d�߯O��I	�&�
U�t�	p��"�t�`���r5!�-b�	
a4�~�MQq�Y�E�@�#㚬�o�v���y��q�����UA �#�BQ�Fj�g
AH�W�0���e*_�"�Mc]26���\��Ŧ?*���\G�v����<��=��4�{�Nmg�_�wS��7,o|      m      x������ � �      {      x������ � �      �      x������ � �      u      x�3�NL��KW()JM����� 8�      q      x������ � �      �   p  x�M��N�0���S̅
�&M	�)R�Z!`9-��J{�8����fl�͍w�y�u@B+ْG�������O�������b�,�E&h�U���{p��h8�Z�������b;���E���J�J@z�{��}s�ȁ��nR_@˦�^6�=���M�Q]!�.���� :< (�����m�$���ô�gD삚�p0*hO�����+�1�xr$���,Mp�Β�n�c)(JL��F���{�n��V.�ٱV*L����&Y��l���/7ŪH�j�^7yF�n1xSƿ���Z�K���^�"���eq=�'%���*��<��)��x���y{�+���6Y=,�~7�}<�ï0�>�۳�.���t:���ӣ      �   �  x�eR1��0��W���2]��)�@$$!�@Is�h�K��p�X����8"�<�k���C[\З���q�
y����&#_ �q����r��l�����V،m�TE3>P@'0�:�� ��6u�`�tSK�����wiO|��Rq�I�I�:��Ha�޸y�q��Z�� ��6��S-�?Q��(����c6�8+�(����e�J�T��ƭ��n�Uc�֌�i�=���9��Lx������V��H�ڳH��O�l�������Dyy�?��c�����`�o�\N	|�,�m��vc\��A�>w�XȇS�l��>d]o������q��ΐ��B+j�
�L	[��o�,锦=}��iEGњ�.�/�pR�4�%�*,�X0}�/�)
V��(7��g��{j�#%׽-)k�ߦ��w������\��      �      x�3�4������� ��      �   s   x���
�0 ���/mV
�$���Zڎ��5#��y��[G�)�TUW 38���kN��'&ͤ�Kg|8������k���c�]���ʝ���zi�GX��Wp�}o�(g      �      x������ � �      �      x�3�4����� ]      �      x������ � �      y   ~   x�5�A� E�p�� L[]yW&n�8Z�0��xzMl����ќ��.�k�p5��Š�L�7�Y�m�YTK;!���5����5$Ỹ Y9+��
�N�t�����+�r����<�v�#{���/�6~      �      x������ � �      �      x������ � �      o      x������ � �     