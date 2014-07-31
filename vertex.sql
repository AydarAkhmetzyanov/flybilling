CREATE SCHEMA [vertex] AUTHORIZATION [dbo]

create table [vertex].[ErrorLog] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [msg] [nvarchar](240) NULL, 
                [url] [nvarchar](720) NULL, 
                [is_warning] [tinyint] DEFAULT 0,
                [timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_ErrorLog] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[Currency] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [rate] [smallmoney] NOT NULL,
                [fromC] [char](3) NOT NULL,
                [toC] [char](3) NOT NULL,
                CONSTRAINT [PK_Currency] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[Clients]  
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [email] [nvarchar](240) NULL,
				[tech_key] [nvarchar](255) NULL,
				[balance] [money] DEFAULT 0, 
                [password] [varchar](255) NOT NULL,
                [timezone] [float](2) DEFAULT 0,
                [language] [char](2) NULL, 
                [ip] [varchar](100) NULL, 
                [country] [char](2) NULL, 
                [status] [tinyint] DEFAULT 1, --0-deleted 1-active 2-baned
				[emailActivationCode] [char](16) NOT NULL,
				[emailActivated] [tinyint] NOT NULL,
                [timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_Clients] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

INSERT INTO [vertex].[Clients] 
(email, tech_key, balance, password, timezone, language, ip, country, status, emailActivationCode, emailActivated) 
VALUES (N'test@test.ru',N'1234',10,'$2y$10$o0/f3x6Q5VyrOTTUr5AD/eIzzLKg.b9ertCrrAfKuqdQiEViXZ0lq',4.0,'ru','87.117.176.162','ru',1, 'qwertyuiopasdfgh', 1);

create table [vertex].[ClientsPrivateData] 
            (
				[ID] [int] IDENTITY(1,1) NOT NULL,
				[phone] [varchar](255) NOT NULL,
				[icq] [int] NULL,
				[serviceName] [nvarchar](500) NOT NULL,
				[serviceURL] [nvarchar](500) NOT NULL,
				[accountType] [tinyint] NOT NULL,
				[firstName] [nvarchar](500) NOT NULL,
				[secondName] [nvarchar](500) NOT NULL,
				[WMR] [char](13) NULL,				
				[PName] [nvarchar](700) NULL,
				[PFIO] [nvarchar](500) NULL,
				[PINN] [char](12) NULL,
				[POGRN] [char](15) NULL,
				[PSGRN] [char](12) NULL,
				[PSGRD] [char](10) NULL,
				[CName] [nvarchar](700) NULL,
				[CINN] [char](10) NULL,
				[CKPP] [char](9) NULL,
				[COGRN] [char](13) NULL,
				[CFIO] [nvarchar](500) NULL,
				[CFIOR] [nvarchar](500) NULL,
				[CPPos] [nvarchar](500) NULL,
				[CPDoc] [nvarchar](700) NULL,
				[UAddr] [nvarchar](700) NULL,
				[UPostAddr] [nvarchar](700) NULL,
				[accountNDS] [tinyint] NULL,
				[bankName] [nvarchar](700) NULL,
				[bankBIK] [char](9) NULL,
				[bankKor] [char](20) NULL,
				[bankAcc] [char](20) NULL,
                CONSTRAINT [PK_ClientsPrivateData] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [vertex].[ClientsPrivateData] 
(phone, icq, serviceName, serviceURL, accountType, firstName, secondName, WMR, PName, PFIO, PINN, POGRN, PSGRN, PSGRD, CName, CINN, CKPP, COGRN, CFIO, CFIOR, CPPos, CPDoc, UAddr, UPostAddr, accountNDS, bankName, bankBIK, bankKor, bankAcc) 
VALUES ('+791234567', 123456789, N'Test Project', N'http://test.ru', 2, N'Иван', N'Иванов', 'R123456789012', N'ИП Иванов Иван Иванович', N'Иванов Иван Иванович', '123456789012', '123456789012345', '12-123456789', '01-01-2013', N'Юридическое имя организации согласно уставу или свидетельству о регистрации', '0123456789', '123456789', '1234567890123', N'Иванов Иван Иванович', N'Иванова Ивана Ивановича', N'Генеральный директор', N'Устава/доверенности №_от_', N'Адрес, номер офиса, индекс', N'Адрес, номер офиса, индекс', 18, N'Полное наименование банка', '123456789', '12345678901234567890', '12345678901234567890');

create table [vertex].[News]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
				[text_ru] [nvarchar](4000) NULL, 
                [text_en] [nvarchar](4000) NULL, 
                [title_ru] [nvarchar](255) NULL, 
                [title_en] [nvarchar](255) NULL,
                CONSTRAINT [PK_News] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[Notifications]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
				[text_ru] [nvarchar](4000) NULL, 
                [text_en] [nvarchar](4000) NULL, 
                [title_ru] [nvarchar](255) NULL, 
                [title_en] [nvarchar](255) NULL,
                [client_ID] [int] DEFAULT NULL,
                [notification_ID] [int] DEFAULT NULL,
                [status] [tinyint] DEFAULT 1, --1-read 0-new
                CONSTRAINT [PK_Notifications] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[Questions]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                [text] [nvarchar](4000) NULL, 
                [client_ID] [int] DEFAULT NULL,
                [notification_ID] [int] DEFAULT NULL,
                [status] [tinyint] DEFAULT 1, --1-read 0-new
                CONSTRAINT [PK_Questions] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[Withdrawals]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                [summ] [money] DEFAULT 0, 
                [client_ID] [int] DEFAULT NULL,
                [status] [tinyint] DEFAULT 1, --1-done 0-new
                CONSTRAINT [PK_Withdrawals] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[Fines]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                [summ] [money] DEFAULT 0, 
                [client_ID] [int] DEFAULT NULL,
                [description] [nvarchar](4000) NULL, 
                CONSTRAINT [PK_Fines] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[FinesOur]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                [summ] [money] DEFAULT 0, 
                [description] [nvarchar](4000) NULL, 
                CONSTRAINT [PK_FinesOur] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[SMS]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
				[response_text] [nvarchar](500) NULL, 
				[response_is_sent] [tinyint] DEFAULT 0,
				[response_is_async] [tinyint] DEFAULT 0,
				[response_is_dynamic] [tinyint] DEFAULT 0,
				[sender_phone] [varchar](255) NULL, 
				[sender_country] [char](2) NULL, 
				[sender_cost] [smallmoney] DEFAULT 0, 
				[sender_service_number] [varchar](255) NULL,
				[sender_text] [nvarchar](500) NULL, 
				[client_share] [smallmoney] DEFAULT 0, 
				[client_ID] [int] DEFAULT NULL, 
				[service_ID] [int] DEFAULT NULL, 
				[provider_ID] [int] DEFAULT NULL,
				[external_ID] [bigint] DEFAULT NULL,
				[external_operator] [nvarchar](255) NULL, 
				[external_operator_ID] [int] DEFAULT NULL, 
				[external_share] [smallmoney] DEFAULT 0,
                [is_fraud] [tinyint] DEFAULT 0,
                CONSTRAINT [PK_SMS] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[SMSServices] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [country] [char](2) NULL, 
				[prefix] [nvarchar](255) NULL,
				[response_static] [nvarchar](500) NULL,
                [is_dynamic] [tinyint] DEFAULT 0,
				[dynamic_responder_URL] [nvarchar](500) NULL,
				[share] [int] DEFAULT 75,
                [status] [tinyint] DEFAULT 1, --0-deleted 1-active 2-disabled(visible)
				[client_ID] [int] DEFAULT NULL, 
				[provider_ID] [int] DEFAULT NULL,
                [is_pseudo] [tinyint] DEFAULT 0,
                [timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_SMSServices] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[SessionSMS]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
				[text] [nvarchar](500) NULL,
				[phone] [varchar](255) NULL, 
				[country] [char](2) NULL, 
				[service_number] [varchar](255) NULL,
				[client_cost] [smallmoney] DEFAULT 0,
				[client_ID] [int] DEFAULT NULL, 
                [service_ID] [int] DEFAULT NULL, 
                CONSTRAINT [PK_SessionSMS] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[SessionServices] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [country] [char](2) NULL, 
				[is_text_unlocked] [tinyint] DEFAULT 1,
                [status] [tinyint] DEFAULT 1, --0-deleted 1-active 2-disabled(visible)
				[default_text] [nvarchar](500) NULL,
				[client_ID] [int] DEFAULT NULL, 
				[provider_ID] [int] DEFAULT NULL,
                [client_service_ID] [int] DEFAULT NULL,
                [timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_SessionServices] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			

create table [vertex].[SMSCorePrefixes] 
            (
			    [ID] [int] IDENTITY(1,1) NOT NULL,
                [prefix] [nvarchar](255) NULL,
                [country] [char](2) NULL,
				[provider_ID] [int] DEFAULT NULL,
                CONSTRAINT [PK_SMSCorePrefixes] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [vertex].[SMSCorePrefixes] 
(prefix, country, provider_ID) 
VALUES (N'hqsws', 'ru', 1); --test
INSERT INTO [vertex].[SMSCorePrefixes] 
(prefix, country, provider_ID) 
VALUES (N'981331', 'ru', 1);
INSERT INTO [vertex].[SMSCorePrefixes] 
(prefix, country, provider_ID) 
VALUES (N'981332', 'ru', 1);
INSERT INTO [vertex].[SMSCorePrefixes] 
(prefix, country, provider_ID) 
VALUES (N'981333', 'ru', 1);


create table [vertex].[SMSProviders] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [name] [nvarchar](500) NULL,
                [description] [nvarchar](2000) NULL,
                [is_async] [tinyint] DEFAULT 0,
                [timestamp] [smalldatetime] DEFAULT GETUTCDATE(),
				[status] [tinyint] DEFAULT 1, --0-hidden 1-active
                [code] [char](2) NULL,
                CONSTRAINT [PK_SMSProviders] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [vertex].[SMSProviders] 
(name, description, is_async, status, code) 
VALUES (N'pl3', N'IFree, лучшие отчисления и большой выбор коротких номеров', 1, 1, 'ru');
	
INSERT INTO [vertex].[SMSProviders] 
(name, description, is_async, status, code) 
VALUES (N'plastic1', N'plastic media proxy1', 0, 1, 'ru');


create table [vertex].[Countries] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [name] [nvarchar](200) NULL,
                [code] [char](2) NULL,
				[a1] [int] NULL,
                [is_available] [tinyint] DEFAULT 0,
                CONSTRAINT [PK_Countries] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

SET IDENTITY_INSERT [vertex].[Countries] ON;

INSERT INTO [vertex].[Countries] (ID, name, code, a1) VALUES
(1, N'Россия', 'ru', 1),
(2, N'Эстония', N'ee', 2),
(3, N'Украина', N'ua', 3),
(4, N'Таджикистан', N'tj', 4),
(5, N'Литва', N'lt', 5),
(6, N'Латвия', N'lv', 6),
(7, N'Киргизия', N'kg', 7),
(8, N'Казахстан', N'kz', 8),
(9, N'Израиль', N'il', 9),
(10, N'Грузия', N'ge', 10),
(11, N'Германия', N'de', 11),
(12, N'Белоруссия', N'by', 12),
(13, N'Армения', N'am', 13),
(14, N'Азербайджан', N'az', 14),
(15, N'Молдавия', N'md', 15),
(16, N'Австрия', N'at', 19),
(17, N'Бельгия', N'be', 21),
(18, N'Болгария', N'bg', 22),
(19, N'Босния и Герцеговина', N'ba', 74),
(20, N'Алжир', N'dz', 88),
(21, N'Бразилия', N'br', 78),
(22, N'Великобритания', N'uk', 59),
(23, N'Венгрия', N'hu', 38),
(24, N'Гондурас', N'hn', 82),
(25, N'Гонконг', N'hk', 75),
(26, N'Греция', N'gr', 36),
(27, N'Дания', N'dk', 30),
(28, N'Доминикан', N'do', 83),
(29, N'Египет', N'eg', 32),
(30, N'Иордания', N'jo', 67),
(31, N'Испания', N'es', 33),
(32, N'Камбоджа', N'kh', 71),
(33, N'Кипр', N'cy', 76),
(34, N'Колумбия', N'co', 28),
(35, N'Косово', N'ko', 73),
(36, N'Ливан', N'lb', 65),
(37, N'Люксембург', N'lu', 41),
(38, N'Македония', N'mk', 45),
(39, N'Малайзия', N'my', 64),
(40, N'Марокко', N'ma', 42),
(41, N'Мексика', N'mx', 46),
(42, N'Нидерланды', N'nl', 48),
(43, N'Никарагуа', N'ni', 85),
(44, N'Новая Зеландия', N'nz', 50),
(45, N'Норвегия', N'no', 49),
(46, N'Панама', N'pa', 86),
(47, N'Перу', N'pe', 51),
(48, N'Польша', N'pl', 52),
(49, N'Португалия', N'pt', 53),
(50, N'Румыния', N'ro', 54),
(51, N'Саудовская Аравия', N'sa', 56),
(52, N'Сербия', N'rs', 55),
(53, N'Словакия', N'sk', 58),
(54, N'Словения', N'si', 72),
(55, N'Тайвань', N'tw', 68),
(56, N'Турция', N'tr', 70),
(57, N'Финляндия', N'fi', 34),
(58, N'Франция', N'fr', 35),
(59, N'Хорватия', N'hr', 37),
(60, N'Черногория', N'me', 44),
(61, N'Чехия', N'cz', 29),
(62, N'Чили', N'cl', 26),
(63, N'Швейцария', N'ch', 25),
(64, N'Швеция', N'se', 57),
(65, N'ЮАР', N'za', 63),
(68, N'Австралия', N'au', 162),
(70, N'Абхазия', N'ab', 0);

UPDATE [vertex].[Countries] SET [is_available]=1;

create table [vertex].[Agregators] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [name] [nvarchar](255) NULL
                CONSTRAINT [PK_Agregators] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

SET IDENTITY_INSERT [vertex].[Agregators] ON;

INSERT INTO [vertex].[Agregators]  (ID, name) VALUES
(1,N'I-Free');

create table [vertex].[Numbers] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [number] [nvarchar](10) NULL,
				[price] [int] NULL,
                [agregator_id] [tinyint] NULL,
                [country_id] [int] NULL,
                [preprefix] [nvarchar](10) NULL,
                CONSTRAINT [PK_Numbers] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

create table [vertex].[Prices] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [number] [nvarchar](20) NULL,
                [cost] [int] NULL,
                [share] [int] NULL,
                [operator_short_name] [nvarchar](255) NULL,
                [code] [char](2) NULL,
                CONSTRAINT [PK_Prices] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );


