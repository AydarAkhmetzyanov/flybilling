create table [dbo].[ErrorLog] 
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

create table [dbo].[Currency] 
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

create table [dbo].[Clients]  
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

INSERT INTO [dbo].[Clients] 
(email, tech_key, balance, password, timezone, language, ip, country, status, emailActivationCode, emailActivated) 
VALUES (N'aydar@creativestripe.ru',N'1234',10,'$2a$04$wM.DTWJ4ejRsn9bW.4buxuvwrMTj2GMFML3BF9CFv.6XCBbKkrdx2',4.0,'ru','87.117.176.162','ru',1, 'qwertyuiopasdfgh', 1);

create table [dbo].[ClientsPrivateData] 
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
			
INSERT INTO [dbo].[ClientsPrivateData] 
(phone, icq, serviceName, serviceURL, accountType, firstName, secondName, WMR, PName, PFIO, PINN, POGRN, PSGRN, PSGRD, CName, CINN, CKPP, COGRN, CFIO, CFIOR, CPPos, CPDoc, UAddr, UPostAddr, accountNDS, bankName, bankBIK, bankKor, bankAcc) 
VALUES ('+791234567', 123456789, N'Test Project', N'http://test.ru', 2, N'Иван', N'Иванов', 'R123456789012', N'ИП Иванов Иван Иванович', N'Иванов Иван Иванович', '123456789012', '123456789012345', '12-123456789', '01-01-2013', N'Юридическое имя организации согласно уставу или свидетельству о регистрации', '0123456789', '123456789', '1234567890123', N'Иванов Иван Иванович', N'Иванова Ивана Ивановича', N'Генеральный директор', N'Устава/доверенности №_от_', N'Адрес, номер офиса, индекс', N'Адрес, номер офиса, индекс', 18, N'Полное наименование банка', '123456789', '12345678901234567890', '12345678901234567890');

create table [dbo].[News]
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
			
INSERT INTO [dbo].[News] 
(text_ru,text_en,title_ru,title_en) 
VALUES (N'test',N'test',N'тест',N'test');

create table [dbo].[Notifications]
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
			
INSERT INTO [dbo].[Notifications] 
(text_ru,text_en,title_ru,title_en,client_ID,notification_ID,status) 
VALUES (N'test',N'test',N'test',N'test',1,NULL,0);
INSERT INTO [dbo].[Notifications] 
(text_ru,text_en,title_ru,title_en,client_ID,notification_ID,status) 
VALUES (N'test2',N'test2',N'test2',N'test2',1,1,0);

create table [dbo].[Questions]
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
			
INSERT INTO [dbo].[Questions] 
(text,client_ID,notification_ID,status) 
VALUES (N'test',1,1,0); 

create table [dbo].[Withdrawals]
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
			
INSERT INTO [dbo].[Withdrawals] 
(summ,client_ID,status) 
VALUES (10,1,0);

create table [dbo].[Fines]
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
			
INSERT INTO [dbo].[Fines] 
(summ,client_ID,description) 
VALUES (5,1,N'fine from provider');

create table [dbo].[FinesOur]
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
			
INSERT INTO [dbo].[FinesOur] 
(summ,client_ID,description) 
VALUES (5,N'fine from provider');

create table [dbo].[SMS]
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
			
INSERT INTO [dbo].[SMS] 
(response_text, response_is_sent, response_is_dynamic, sender_phone, sender_country, sender_cost, sender_service_number, sender_text, client_share, client_ID, service_ID, provider_ID
, external_ID, external_operator, external_operator_ID, external_share) 
VALUES (N'response_text', 0, 1, '79510665133', 'ru', 10, '4443', N'sender_text', 5, 1, 1, 1
, 1, N'rostelecom', 1, 9,0);
INSERT INTO [dbo].[SMS] 
(response_text, response_is_sent, response_is_dynamic, sender_phone, sender_country, sender_cost, sender_service_number, sender_text, client_share, client_ID, service_ID, provider_ID
, external_ID, external_operator, external_operator_ID, external_share) 
VALUES (N'response_text', 1, 1, '79510665133', 'ru', 10, '4443', N'sender_text', 5, 1, 1, 1
, 34484459280, N'rostelecom', 1, 9,0);

create table [dbo].[SMSServices] 
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
			
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', N'kmbord566', 'response_static', 1, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0);
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', N'kmbords', 'response_static', 0, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0);
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', N'kmbordd', 'response_static', 1, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0);

create table [dbo].[SessionSMS]
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
			
INSERT INTO [dbo].[SessionSMS] 
(text, phone, country, service_number, client_cost, client_ID, service_ID) 
VALUES (N'response_text', '79510665133', 'ru', '4443', 0.3, 1, 1);

create table [dbo].[SessionServices] 
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
			
INSERT INTO [dbo].[SessionServices] 
(country, is_text_unlocked, status, default_text, client_ID, provider_ID, client_service_ID) 
VALUES ('ru', 1, 1, N'smstext', 1, 1, 2);

create table [dbo].[SMSCorePrefixes] 
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
			
INSERT INTO [dbo].[SMSCorePrefixes] 
(prefix, country, provider_ID) 
VALUES (N'kmbord', 'ru', 1);

create table [dbo].[SMSProviders] 
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
			
INSERT INTO [dbo].[SMSProviders] 
(name, description, is_async, status, code) 
VALUES (N'pl3', N'IFree, лучшие отчисления и большой выбор коротких номеров', 1, 1, 'ru');
	


create table [dbo].[Countries] 
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

SET IDENTITY_INSERT [dbo].[Countries] ON;

INSERT INTO [dbo].[Countries] (ID, name, code, a1) VALUES
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

create table [dbo].[Agregators] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [name] [nvarchar](255) NULL
                CONSTRAINT [PK_Agregators] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

SET IDENTITY_INSERT [dbo].[Agregators] ON;

INSERT INTO [dbo].[Agregators]  (ID, name) VALUES
(1,N'I-Free');

create table [dbo].[Numbers] 
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

SET IDENTITY_INSERT [dbo].[Numbers] ON;

INSERT INTO [dbo].[Numbers]  (ID, number, price, agregator_id, country_id, preprefix) VALUES
(117, N'4445', 1934, 1, 1, N''),
(119, N'4447', 3643, 1, 1, N''),
(120, N'4448', 6157, 1, 1, N''),
(122, N'4443', 515, 1, 1, N''),
(123, N'7495', 10542, 1, 1, N''),
(124, N'7496', 14926, 1, 1, N''),
(125, N'7497', 21987, 1, 1, N''),
(126, N'7498', 30756, 1, 1, N''),
(129, N'4169', 2909, 1, 1, N''),
(130, N'4161', 15709, 1, 1, N''),
(131, N'7733', 30094, 1, 1, N''),
(132, N'4107', 12066, 1, 1, N''),
(133, N'4444', 1086, 1, 1, N'');

create table [dbo].[Prices] 
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

SET IDENTITY_INSERT [dbo].[Prices] ON;

INSERT INTO [dbo].[Prices] (id, number, cost, share, operator_short_name, code) VALUES
(5116, N'4446', 3000, 1974, N'ОСМП', 'ru'),
(5117, N'4447', 4000, 2633, N'ОСМП', 'ru'),
(5118, N'4448', 6000, 3948, N'ОСМП', 'ru'),
(5119, N'4449', 9000, 5922, N'ОСМП', 'ru'),
(5120, N'4440', 170, 80, N'TELE2 Россия', 'ru'),
(5121, N'4442', 250, 118, N'TELE2 Россия', 'ru'),
(5122, N'4443', 500, 235, N'TELE2 Россия', 'ru'),
(5123, N'4444', 999, 471, N'TELE2 Россия', 'ru'),
(5124, N'4445', 2050, 964, N'TELE2 Россия', 'ru'),
(5125, N'4446', 3351, 1575, N'TELE2 Россия', 'ru'),
(5126, N'4447', 4130, 1941, N'TELE2 Россия', 'ru'),
(5127, N'4448', 6772, 3184, N'TELE2 Россия', 'ru'),
(5128, N'4449', 10159, 4775, N'TELE2 Россия', 'ru'),
(5129, N'7492', 170, 80, N'TELE2 Россия', 'ru'),
(5130, N'7494', 170, 80, N'TELE2 Россия', 'ru'),
(5131, N'7495', 11999, 5640, N'TELE2 Россия', 'ru'),
(5132, N'7496', 17000, 7991, N'TELE2 Россия', 'ru'),
(5133, N'7497', 24999, 11749, N'TELE2 Россия', 'ru'),
(5134, N'7498', 24999, 11749, N'TELE2 Россия', 'ru'),
(5135, N'4440', 177, 83, N'АКОС', 'ru'),
(5136, N'4442', 389, 183, N'АКОС', 'ru'),
(5137, N'4443', 531, 250, N'АКОС', 'ru'),
(5138, N'4444', 1074, 505, N'АКОС', 'ru'),
(5139, N'4445', 2148, 1009, N'АКОС', 'ru'),
(5140, N'4446', 3221, 1514, N'АКОС', 'ru'),
(5141, N'4447', 4449, 2091, N'АКОС', 'ru'),
(5142, N'4448', 7151, 3361, N'АКОС', 'ru'),
(5143, N'4449', 10714, 5036, N'АКОС', 'ru'),
(5144, N'7494', 170, 80, N'АКОС', 'ru'),
(5145, N'7495', 11999, 5639, N'АКОС', 'ru'),
(5146, N'7496', 17000, 7990, N'АКОС', 'ru'),
(5147, N'7497', 24999, 11749, N'АКОС', 'ru'),
(5148, N'7498', 35000, 16450, N'АКОС', 'ru'),
(5149, N'4440', 170, 80, N'Билайн', 'ru'),
(5150, N'4442', 240, 135, N'Билайн', 'ru'),
(5151, N'4443', 500, 235, N'Билайн', 'ru'),
(5152, N'4444', 1001, 471, N'Билайн', 'ru'),
(5153, N'4445', 2000, 940, N'Билайн', 'ru'),
(5154, N'4446', 3500, 1645, N'Билайн', 'ru'),
(5155, N'4447', 4000, 1880, N'Билайн', 'ru'),
(5156, N'4448', 7000, 3290, N'Билайн', 'ru'),
(5157, N'4449', 11000, 6204, N'Билайн', 'ru'),
(5158, N'7492', 170, 96, N'Билайн', 'ru'),
(5159, N'7494', 170, 96, N'Билайн', 'ru'),
(5160, N'7495', 13000, 6110, N'Билайн', 'ru'),
(5161, N'7496', 17000, 7990, N'Билайн', 'ru'),
(5162, N'7497', 20000, 9400, N'Билайн', 'ru'),
(5163, N'7498', 30000, 14100, N'Билайн', 'ru'),
(5164, N'4440', 140, 66, N'НСС', 'ru'),
(5165, N'4442', 253, 119, N'НСС', 'ru'),
(5166, N'4443', 498, 234, N'НСС', 'ru'),
(5167, N'4444', 995, 467, N'НСС', 'ru'),
(5168, N'4445', 1968, 925, N'НСС', 'ru'),
(5169, N'4446', 3290, 1546, N'НСС', 'ru'),
(5170, N'4447', 4314, 2027, N'НСС', 'ru'),
(5171, N'4448', 6636, 3119, N'НСС', 'ru'),
(5172, N'4449', 9954, 4679, N'НСС', 'ru'),
(5173, N'7494', 140, 66, N'НСС', 'ru'),
(5174, N'7495', 11614, 5459, N'НСС', 'ru'),
(5175, N'7496', 15000, 7050, N'НСС', 'ru'),
(5176, N'7497', 24999, 11749, N'НСС', 'ru'),
(5177, N'7498', 30000, 14100, N'НСС', 'ru'),
(5178, N'4440', 170, 80, N'Кодотел', 'ru'),
(5179, N'4442', 380, 178, N'Кодотел', 'ru'),
(5180, N'4443', 500, 235, N'Кодотел', 'ru'),
(5181, N'4444', 1001, 471, N'Кодотел', 'ru'),
(5182, N'4445', 2000, 940, N'Кодотел', 'ru'),
(5183, N'4446', 3500, 1645, N'Кодотел', 'ru'),
(5184, N'4447', 4130, 1941, N'Кодотел', 'ru'),
(5185, N'4448', 7000, 3290, N'Кодотел', 'ru'),
(5186, N'4449', 11000, 5170, N'Кодотел', 'ru'),
(5187, N'7494', 170, 80, N'Кодотел', 'ru'),
(5188, N'7495', 11999, 5639, N'Кодотел', 'ru'),
(5189, N'7496', 17000, 7990, N'Кодотел', 'ru'),
(5190, N'7497', 24999, 11749, N'Кодотел', 'ru'),
(5191, N'7498', 35000, 16450, N'Кодотел', 'ru'),
(5192, N'4440', 177, 72, N'Мегафон Дальневосточный ф-л', 'ru'),
(5193, N'4442', 248, 113, N'Мегафон Дальневосточный ф-л', 'ru'),
(5194, N'4443', 590, 316, N'Мегафон Дальневосточный ф-л', 'ru'),
(5195, N'4444', 1180, 666, N'Мегафон Дальневосточный ф-л', 'ru'),
(5196, N'4445', 2242, 1294, N'Мегафон Дальневосточный ф-л', 'ru'),
(5197, N'4446', 3422, 1993, N'Мегафон Дальневосточный ф-л', 'ru'),
(5198, N'4447', 4130, 2412, N'Мегафон Дальневосточный ф-л', 'ru'),
(5199, N'4448', 10502, 6186, N'Мегафон Дальневосточный ф-л', 'ru'),
(5200, N'4449', 14042, 8282, N'Мегафон Дальневосточный ф-л', 'ru'),
(5201, N'7492', 177, 72, N'Мегафон Дальневосточный ф-л', 'ru'),
(5202, N'7494', 177, 72, N'Мегафон Дальневосточный ф-л', 'ru'),
(5203, N'7495', 11999, 7073, N'Мегафон Дальневосточный ф-л', 'ru'),
(5204, N'7496', 17000, 10035, N'Мегафон Дальневосточный ф-л', 'ru'),
(5205, N'7497', 24999, 14771, N'Мегафон Дальневосточный ф-л', 'ru'),
(5206, N'7498', 35400, 20931, N'Мегафон Дальневосточный ф-л', 'ru'),
(5207, N'4440', 177, 66, N'Мегафон Кавказский ф-л', 'ru'),
(5208, N'4442', 248, 106, N'Мегафон Кавказский ф-л', 'ru'),
(5209, N'4443', 590, 300, N'Мегафон Кавказский ф-л', 'ru'),
(5210, N'4444', 1180, 632, N'Мегафон Кавказский ф-л', 'ru'),
(5211, N'4445', 2242, 1231, N'Мегафон Кавказский ф-л', 'ru'),
(5212, N'4446', 3422, 1896, N'Мегафон Кавказский ф-л', 'ru'),
(5213, N'4447', 4130, 2296, N'Мегафон Кавказский ф-л', 'ru'),
(5214, N'4448', 10502, 5889, N'Мегафон Кавказский ф-л', 'ru'),
(5215, N'4449', 14042, 7886, N'Мегафон Кавказский ф-л', 'ru'),
(5216, N'7492', 177, 66, N'Мегафон Кавказский ф-л', 'ru'),
(5217, N'7494', 177, 66, N'Мегафон Кавказский ф-л', 'ru'),
(5218, N'7495', 11999, 6734, N'Мегафон Кавказский ф-л', 'ru'),
(5219, N'7496', 17000, 9554, N'Мегафон Кавказский ф-л', 'ru'),
(5220, N'7497', 24999, 14067, N'Мегафон Кавказский ф-л', 'ru'),
(5221, N'7498', 35400, 19933, N'Мегафон Кавказский ф-л', 'ru'),
(5222, N'4440', 177, 72, N'Мегафон Поволжский ф-л', 'ru'),
(5223, N'4442', 248, 146, N'Мегафон Поволжский ф-л', 'ru'),
(5224, N'4443', 590, 316, N'Мегафон Поволжский ф-л', 'ru'),
(5225, N'4444', 1180, 666, N'Мегафон Поволжский ф-л', 'ru'),
(5226, N'4445', 2242, 1294, N'Мегафон Поволжский ф-л', 'ru'),
(5227, N'4446', 3422, 1993, N'Мегафон Поволжский ф-л', 'ru'),
(5228, N'4447', 4130, 2412, N'Мегафон Поволжский ф-л', 'ru'),
(5229, N'4448', 10502, 6186, N'Мегафон Поволжский ф-л', 'ru'),
(5230, N'4449', 14042, 8282, N'Мегафон Поволжский ф-л', 'ru'),
(5231, N'7492', 177, 72, N'Мегафон Поволжский ф-л', 'ru'),
(5232, N'7494', 177, 72, N'Мегафон Поволжский ф-л', 'ru'),
(5233, N'7495', 11999, 7073, N'Мегафон Поволжский ф-л', 'ru'),
(5234, N'7496', 17000, 10035, N'Мегафон Поволжский ф-л', 'ru'),
(5235, N'7497', 24999, 14771, N'Мегафон Поволжский ф-л', 'ru'),
(5236, N'7498', 35400, 20931, N'Мегафон Поволжский ф-л', 'ru'),
(5237, N'4440', 177, 72, N'Мегафон СЗ филиал', 'ru'),
(5238, N'4442', 248, 146, N'Мегафон СЗ филиал', 'ru'),
(5239, N'4443', 590, 316, N'Мегафон СЗ филиал', 'ru'),
(5240, N'4444', 1180, 666, N'Мегафон СЗ филиал', 'ru'),
(5241, N'4445', 2242, 1294, N'Мегафон СЗ филиал', 'ru'),
(5242, N'4446', 3422, 1993, N'Мегафон СЗ филиал', 'ru'),
(5243, N'4447', 4130, 2412, N'Мегафон СЗ филиал', 'ru'),
(5244, N'4448', 10502, 6186, N'Мегафон СЗ филиал', 'ru'),
(5245, N'4449', 14042, 8282, N'Мегафон СЗ филиал', 'ru'),
(5246, N'7492', 177, 72, N'Мегафон СЗ филиал', 'ru'),
(5247, N'7494', 177, 72, N'Мегафон СЗ филиал', 'ru'),
(5248, N'7495', 11999, 7073, N'Мегафон СЗ филиал', 'ru'),
(5249, N'7496', 17000, 10035, N'Мегафон СЗ филиал', 'ru'),
(5250, N'7497', 24999, 14771, N'Мегафон СЗ филиал', 'ru'),
(5251, N'7498', 35400, 20931, N'Мегафон СЗ филиал', 'ru'),
(5252, N'4440', 177, 72, N'Мегафон Сибирский ф-л', 'ru'),
(5253, N'4442', 248, 113, N'Мегафон Сибирский ф-л', 'ru'),
(5254, N'4443', 590, 316, N'Мегафон Сибирский ф-л', 'ru'),
(5255, N'4444', 1180, 666, N'Мегафон Сибирский ф-л', 'ru'),
(5256, N'4445', 2242, 1294, N'Мегафон Сибирский ф-л', 'ru'),
(5257, N'4446', 3422, 1993, N'Мегафон Сибирский ф-л', 'ru'),
(5258, N'4447', 4130, 2412, N'Мегафон Сибирский ф-л', 'ru'),
(5259, N'4448', 10502, 6186, N'Мегафон Сибирский ф-л', 'ru'),
(5260, N'4449', 14042, 8282, N'Мегафон Сибирский ф-л', 'ru'),
(5261, N'7492', 177, 72, N'Мегафон Сибирский ф-л', 'ru'),
(5262, N'7494', 177, 72, N'Мегафон Сибирский ф-л', 'ru'),
(5263, N'7495', 11999, 7073, N'Мегафон Сибирский ф-л', 'ru'),
(5264, N'7496', 17000, 10035, N'Мегафон Сибирский ф-л', 'ru'),
(5265, N'7497', 24999, 14771, N'Мегафон Сибирский ф-л', 'ru'),
(5266, N'7498', 35400, 20931, N'Мегафон Сибирский ф-л', 'ru'),
(5267, N'4440', 177, 72, N'Мегафон Столичный ф-л', 'ru'),
(5268, N'4442', 248, 139, N'Мегафон Столичный ф-л', 'ru'),
(5269, N'4443', 590, 316, N'Мегафон Столичный ф-л', 'ru'),
(5270, N'4444', 1180, 666, N'Мегафон Столичный ф-л', 'ru'),
(5271, N'4445', 2242, 1294, N'Мегафон Столичный ф-л', 'ru'),
(5272, N'4446', 3422, 1993, N'Мегафон Столичный ф-л', 'ru'),
(5273, N'4447', 4130, 2412, N'Мегафон Столичный ф-л', 'ru'),
(5274, N'4448', 10502, 6186, N'Мегафон Столичный ф-л', 'ru'),
(5275, N'4449', 14042, 8282, N'Мегафон Столичный ф-л', 'ru'),
(5276, N'7492', 177, 66, N'Мегафон Столичный ф-л', 'ru'),
(5277, N'7494', 177, 72, N'Мегафон Столичный ф-л', 'ru'),
(5278, N'7495', 11999, 7073, N'Мегафон Столичный ф-л', 'ru'),
(5279, N'7496', 17000, 10035, N'Мегафон Столичный ф-л', 'ru'),
(5280, N'7497', 24999, 14771, N'Мегафон Столичный ф-л', 'ru'),
(5281, N'7498', 35400, 20931, N'Мегафон Столичный ф-л', 'ru'),
(5282, N'4440', 177, 66, N'Мегафон Уральский ф-л', 'ru'),
(5283, N'4442', 248, 106, N'Мегафон Уральский ф-л', 'ru'),
(5284, N'4443', 590, 300, N'Мегафон Уральский ф-л', 'ru'),
(5285, N'4444', 1180, 632, N'Мегафон Уральский ф-л', 'ru'),
(5286, N'4445', 2242, 1231, N'Мегафон Уральский ф-л', 'ru'),
(5287, N'4446', 3422, 1896, N'Мегафон Уральский ф-л', 'ru'),
(5288, N'4447', 4130, 2296, N'Мегафон Уральский ф-л', 'ru'),
(5289, N'4448', 10502, 5889, N'Мегафон Уральский ф-л', 'ru'),
(5290, N'4449', 14042, 7886, N'Мегафон Уральский ф-л', 'ru'),
(5291, N'7492', 177, 66, N'Мегафон Уральский ф-л', 'ru'),
(5292, N'7494', 177, 66, N'Мегафон Уральский ф-л', 'ru'),
(5293, N'7495', 11999, 6734, N'Мегафон Уральский ф-л', 'ru'),
(5294, N'7496', 17000, 9554, N'Мегафон Уральский ф-л', 'ru'),
(5295, N'7497', 24999, 14067, N'Мегафон Уральский ф-л', 'ru'),
(5296, N'7498', 35400, 19933, N'Мегафон Уральский ф-л', 'ru'),
(5297, N'4440', 177, 66, N'Мегафон Центральный ф-л', 'ru'),
(5298, N'4442', 248, 139, N'Мегафон Центральный ф-л', 'ru'),
(5299, N'4443', 590, 300, N'Мегафон Центральный ф-л', 'ru'),
(5300, N'4444', 1180, 632, N'Мегафон Центральный ф-л', 'ru'),
(5301, N'4445', 2242, 1231, N'Мегафон Центральный ф-л', 'ru'),
(5302, N'4446', 3422, 1896, N'Мегафон Центральный ф-л', 'ru'),
(5303, N'4447', 4130, 2296, N'Мегафон Центральный ф-л', 'ru'),
(5304, N'4448', 10502, 5889, N'Мегафон Центральный ф-л', 'ru'),
(5305, N'4449', 14042, 7886, N'Мегафон Центральный ф-л', 'ru'),
(5306, N'7492', 177, 66, N'Мегафон Центральный ф-л', 'ru'),
(5307, N'7494', 177, 66, N'Мегафон Центральный ф-л', 'ru'),
(5308, N'7495', 11999, 6734, N'Мегафон Центральный ф-л', 'ru'),
(5309, N'7496', 17000, 9554, N'Мегафон Центральный ф-л', 'ru'),
(5310, N'7497', 24999, 14067, N'Мегафон Центральный ф-л', 'ru'),
(5311, N'7498', 35400, 19933, N'Мегафон Центральный ф-л', 'ru'),
(5312, N'4440', 177, 58, N'Остелеком', 'ru'),
(5313, N'4442', 248, 129, N'Остелеком', 'ru'),
(5314, N'4443', 590, 271, N'Остелеком', 'ru'),
(5315, N'4444', 1180, 577, N'Остелеком', 'ru'),
(5316, N'4445', 2242, 1126, N'Остелеком', 'ru'),
(5317, N'4446', 3422, 1736, N'Остелеком', 'ru'),
(5318, N'4447', 4130, 2102, N'Остелеком', 'ru'),
(5319, N'4448', 10502, 5396, N'Остелеком', 'ru'),
(5320, N'4449', 14042, 7226, N'Остелеком', 'ru'),
(5321, N'7494', 177, 58, N'Остелеком', 'ru'),
(5322, N'7495', 11999, 6170, N'Остелеком', 'ru'),
(5323, N'7496', 17000, 8756, N'Остелеком', 'ru'),
(5324, N'7497', 24999, 12892, N'Остелеком', 'ru'),
(5325, N'7498', 35400, 18269, N'Остелеком', 'ru'),
(5326, N'4440', 181, 85, N'Мотив', 'ru'),
(5327, N'4442', 391, 183, N'Мотив', 'ru'),
(5328, N'4443', 590, 277, N'Мотив', 'ru'),
(5329, N'4444', 1180, 555, N'Мотив', 'ru'),
(5330, N'4445', 2250, 1057, N'Мотив', 'ru'),
(5331, N'4446', 3426, 1611, N'Мотив', 'ru'),
(5332, N'4447', 4130, 1941, N'Мотив', 'ru'),
(5333, N'4448', 6970, 3276, N'Мотив', 'ru'),
(5334, N'4449', 10500, 4935, N'Мотив', 'ru'),
(5335, N'7494', 170, 80, N'Мотив', 'ru'),
(5336, N'7495', 11999, 5640, N'Мотив', 'ru'),
(5337, N'7496', 17000, 7990, N'Мотив', 'ru'),
(5338, N'7497', 24999, 11750, N'Мотив', 'ru'),
(5339, N'7498', 35000, 16450, N'Мотив', 'ru'),
(5340, N'4440', 170, 80, N'МТС', 'ru'),
(5341, N'4442', 237, 111, N'МТС', 'ru'),
(5342, N'4443', 509, 240, N'МТС', 'ru'),
(5343, N'4444', 1016, 478, N'МТС', 'ru'),
(5344, N'4445', 2032, 955, N'МТС', 'ru'),
(5345, N'4446', 3352, 1575, N'МТС', 'ru'),
(5346, N'4447', 4234, 1989, N'МТС', 'ru'),
(5347, N'4448', 6773, 3184, N'МТС', 'ru'),
(5348, N'4449', 10160, 4775, N'МТС', 'ru'),
(5349, N'7492', 170, 80, N'МТС', 'ru'),
(5350, N'7494', 170, 80, N'МТС', 'ru'),
(5351, N'7495', 11999, 5639, N'МТС', 'ru'),
(5352, N'7496', 16933, 7958, N'МТС', 'ru'),
(5353, N'7497', 24000, 11280, N'МТС', 'ru'),
(5354, N'7498', 30479, 14325, N'МТС', 'ru'),
(5355, N'4440', 170, 65, N'НТК', 'ru'),
(5356, N'4442', 240, 90, N'НТК', 'ru'),
(5357, N'4443', 500, 188, N'НТК', 'ru'),
(5358, N'4444', 1001, 376, N'НТК', 'ru'),
(5359, N'4445', 2000, 752, N'НТК', 'ru'),
(5360, N'4446', 3500, 1316, N'НТК', 'ru'),
(5361, N'4447', 4000, 1504, N'НТК', 'ru'),
(5362, N'4448', 7000, 2633, N'НТК', 'ru'),
(5363, N'4449', 11000, 4136, N'НТК', 'ru'),
(5364, N'7494', 170, 65, N'НТК', 'ru'),
(5365, N'7495', 13000, 4889, N'НТК', 'ru'),
(5366, N'7496', 17000, 6392, N'НТК', 'ru'),
(5367, N'7497', 20000, 7520, N'НТК', 'ru'),
(5368, N'7498', 30000, 11280, N'НТК', 'ru'),
(5369, N'4440', 177, 100, N'БайкалВестКом', 'ru'),
(5370, N'4442', 389, 219, N'БайкалВестКом', 'ru'),
(5371, N'4443', 590, 333, N'БайкалВестКом', 'ru'),
(5372, N'4444', 1180, 666, N'БайкалВестКом', 'ru'),
(5373, N'4445', 2242, 1265, N'БайкалВестКом', 'ru'),
(5374, N'4446', 3422, 1930, N'БайкалВестКом', 'ru'),
(5375, N'4447', 4130, 2329, N'БайкалВестКом', 'ru'),
(5376, N'4448', 6962, 3927, N'БайкалВестКом', 'ru'),
(5377, N'4449', 10502, 5924, N'БайкалВестКом', 'ru'),
(5378, N'7494', 170, 96, N'БайкалВестКом', 'ru'),
(5379, N'7495', 11999, 6767, N'БайкалВестКом', 'ru'),
(5380, N'7496', 17000, 9589, N'БайкалВестКом', 'ru'),
(5381, N'7497', 24999, 14100, N'БайкалВестКом', 'ru'),
(5382, N'7498', 35000, 19740, N'БайкалВестКом', 'ru'),
(5383, N'4440', 144, 67, N'Енисейтелеком', 'ru'),
(5384, N'4442', 389, 183, N'Енисейтелеком', 'ru'),
(5385, N'4443', 509, 240, N'Енисейтелеком', 'ru'),
(5386, N'4444', 1062, 499, N'Енисейтелеком', 'ru'),
(5387, N'4445', 2124, 998, N'Енисейтелеком', 'ru'),
(5388, N'4446', 3505, 1647, N'Енисейтелеком', 'ru'),
(5389, N'4447', 4130, 1941, N'Енисейтелеком', 'ru'),
(5390, N'4448', 7080, 3328, N'Енисейтелеком', 'ru'),
(5391, N'4449', 10620, 4991, N'Енисейтелеком', 'ru'),
(5392, N'7494', 170, 80, N'Енисейтелеком', 'ru'),
(5393, N'7495', 11999, 5640, N'Енисейтелеком', 'ru'),
(5394, N'7496', 17000, 7990, N'Енисейтелеком', 'ru'),
(5395, N'7497', 24999, 11750, N'Енисейтелеком', 'ru'),
(5396, N'7498', 35000, 16450, N'Енисейтелеком', 'ru'),
(5397, N'4443', 509, 287, N'СТЕК GSM', 'ru'),
(5398, N'4440', 148, 77, N'Дельта-Телеком', 'ru'),
(5399, N'4442', 324, 168, N'Дельта-Телеком', 'ru'),
(5400, N'4443', 492, 255, N'Дельта-Телеком', 'ru'),
(5401, N'4444', 983, 509, N'Дельта-Телеком', 'ru'),
(5402, N'4445', 1868, 965, N'Дельта-Телеком', 'ru'),
(5403, N'4446', 2852, 1475, N'Дельта-Телеком', 'ru'),
(5404, N'4447', 4130, 2136, N'Дельта-Телеком', 'ru'),
(5405, N'4448', 5900, 3050, N'Дельта-Телеком', 'ru'),
(5406, N'4449', 10620, 5491, N'Дельта-Телеком', 'ru'),
(5407, N'7494', 177, 92, N'Дельта-Телеком', 'ru'),
(5408, N'7495', 11999, 6203, N'Дельта-Телеком', 'ru'),
(5409, N'7496', 17000, 8789, N'Дельта-Телеком', 'ru'),
(5410, N'7497', 24999, 12925, N'Дельта-Телеком', 'ru'),
(5411, N'7498', 35000, 18095, N'Дельта-Телеком', 'ru'),
(5412, N'4440', 148, 77, N'Скайлинк', 'ru'),
(5413, N'4442', 324, 168, N'Скайлинк', 'ru'),
(5414, N'4443', 492, 255, N'Скайлинк', 'ru'),
(5415, N'4444', 983, 509, N'Скайлинк', 'ru'),
(5416, N'4445', 1868, 965, N'Скайлинк', 'ru'),
(5417, N'4446', 2852, 1475, N'Скайлинк', 'ru'),
(5418, N'4447', 4130, 2136, N'Скайлинк', 'ru'),
(5419, N'4448', 5900, 3050, N'Скайлинк', 'ru'),
(5420, N'4449', 10620, 5491, N'Скайлинк', 'ru'),
(5421, N'7494', 177, 92, N'Скайлинк', 'ru'),
(5422, N'7495', 11999, 6203, N'Скайлинк', 'ru'),
(5423, N'7496', 17000, 8789, N'Скайлинк', 'ru'),
(5424, N'7497', 24999, 12925, N'Скайлинк', 'ru'),
(5425, N'7498', 35000, 18095, N'Скайлинк', 'ru'),
(5426, N'4440', 177, 83, N'Астрахань GSM', 'ru'),
(5427, N'4442', 389, 183, N'Астрахань GSM', 'ru'),
(5428, N'4443', 599, 277, N'Астрахань GSM', 'ru'),
(5429, N'4444', 1200, 555, N'Астрахань GSM', 'ru'),
(5430, N'4445', 2200, 1054, N'Астрахань GSM', 'ru'),
(5431, N'4446', 3422, 1608, N'Астрахань GSM', 'ru'),
(5432, N'4447', 4130, 1941, N'Астрахань GSM', 'ru'),
(5433, N'4448', 7000, 3272, N'Астрахань GSM', 'ru'),
(5434, N'4449', 10500, 4936, N'Астрахань GSM', 'ru'),
(5435, N'7494', 170, 96, N'Астрахань GSM', 'ru'),
(5436, N'7495', 11999, 6768, N'Астрахань GSM', 'ru'),
(5437, N'7496', 17000, 9588, N'Астрахань GSM', 'ru'),
(5438, N'7497', 24999, 14100, N'Астрахань GSM', 'ru'),
(5439, N'7498', 35000, 19740, N'Астрахань GSM', 'ru'),
(5440, N'4440', 177, 83, N'Волгоград GSM (С)', 'ru'),
(5441, N'4442', 250, 118, N'Волгоград GSM (С)', 'ru'),
(5442, N'4444', 1180, 555, N'Волгоград GSM (С)', 'ru'),
(5443, N'4445', 2242, 1054, N'Волгоград GSM (С)', 'ru'),
(5444, N'4446', 3422, 1608, N'Волгоград GSM (С)', 'ru'),
(5445, N'4447', 4130, 1941, N'Волгоград GSM (С)', 'ru'),
(5446, N'4448', 6962, 3272, N'Волгоград GSM (С)', 'ru'),
(5447, N'4449', 10502, 4936, N'Волгоград GSM (С)', 'ru'),
(5448, N'7494', 177, 83, N'Волгоград GSM (С)', 'ru'),
(5449, N'7495', 11999, 5639, N'Волгоград GSM (С)', 'ru'),
(5450, N'7496', 17000, 7990, N'Волгоград GSM (С)', 'ru'),
(5451, N'7497', 24999, 11749, N'Волгоград GSM (С)', 'ru'),
(5452, N'7498', 35000, 16450, N'Волгоград GSM (С)', 'ru'),
(5453, N'4440', 199, 94, N'Пенза-GSM (Т)', 'ru'),
(5454, N'4442', 400, 188, N'Пенза-GSM (Т)', 'ru'),
(5455, N'4443', 500, 235, N'Пенза-GSM (Т)', 'ru'),
(5456, N'4444', 1100, 517, N'Пенза-GSM (Т)', 'ru'),
(5457, N'4445', 2100, 986, N'Пенза-GSM (Т)', 'ru'),
(5458, N'4446', 3200, 1504, N'Пенза-GSM (Т)', 'ru'),
(5459, N'4447', 4600, 2162, N'Пенза-GSM (Т)', 'ru'),
(5460, N'4448', 7100, 3337, N'Пенза-GSM (Т)', 'ru'),
(5461, N'4449', 10600, 4982, N'Пенза-GSM (Т)', 'ru'),
(5462, N'7494', 177, 83, N'Пенза-GSM (Т)', 'ru'),
(5463, N'4440', 150, 64, N'Смартс', 'ru'),
(5464, N'4442', 391, 165, N'Смартс', 'ru'),
(5465, N'4443', 599, 254, N'Смартс', 'ru'),
(5466, N'4444', 1200, 507, N'Смартс', 'ru'),
(5467, N'4445', 2655, 1123, N'Смартс', 'ru'),
(5468, N'4446', 4000, 1692, N'Смартс', 'ru'),
(5469, N'4447', 4130, 1746, N'Смартс', 'ru'),
(5470, N'4448', 8400, 3553, N'Смартс', 'ru'),
(5471, N'4449', 12399, 5245, N'Смартс', 'ru'),
(5472, N'7494', 170, 72, N'Смартс', 'ru'),
(5473, N'7495', 11999, 5076, N'Смартс', 'ru'),
(5474, N'7496', 17000, 7191, N'Смартс', 'ru'),
(5475, N'7497', 24999, 10575, N'Смартс', 'ru'),
(5476, N'7498', 35000, 14805, N'Смартс', 'ru'),
(5477, N'4440', 170, 80, N'Смартс-Иваново GSM', 'ru'),
(5478, N'4442', 391, 183, N'Смартс-Иваново GSM', 'ru'),
(5479, N'4443', 590, 277, N'Смартс-Иваново GSM', 'ru'),
(5480, N'4444', 1180, 555, N'Смартс-Иваново GSM', 'ru'),
(5481, N'4445', 2200, 1034, N'Смартс-Иваново GSM', 'ru'),
(5482, N'4446', 3400, 1598, N'Смартс-Иваново GSM', 'ru'),
(5483, N'4447', 4130, 1941, N'Смартс-Иваново GSM', 'ru'),
(5484, N'4448', 7000, 3290, N'Смартс-Иваново GSM', 'ru'),
(5485, N'4449', 10500, 4935, N'Смартс-Иваново GSM', 'ru'),
(5486, N'4440', 100, 47, N'Шупашкар-GSM (Т)', 'ru'),
(5487, N'4442', 391, 183, N'Шупашкар-GSM (Т)', 'ru'),
(5488, N'4443', 530, 249, N'Шупашкар-GSM (Т)', 'ru'),
(5489, N'4444', 1100, 517, N'Шупашкар-GSM (Т)', 'ru'),
(5490, N'4445', 2200, 1034, N'Шупашкар-GSM (Т)', 'ru'),
(5491, N'4446', 3422, 1608, N'Шупашкар-GSM (Т)', 'ru'),
(5492, N'4447', 4130, 1941, N'Шупашкар-GSM (Т)', 'ru'),
(5493, N'4448', 7100, 3337, N'Шупашкар-GSM (Т)', 'ru'),
(5494, N'4449', 10700, 5029, N'Шупашкар-GSM (Т)', 'ru'),
(5495, N'7494', 170, 80, N'Шупашкар-GSM (Т)', 'ru'),
(5496, N'7495', 11999, 5640, N'Шупашкар-GSM (Т)', 'ru'),
(5497, N'7496', 17000, 7990, N'Шупашкар-GSM (Т)', 'ru'),
(5498, N'7497', 24999, 11750, N'Шупашкар-GSM (Т)', 'ru'),
(5499, N'7498', 35000, 16450, N'Шупашкар-GSM (Т)', 'ru'),
(5500, N'4440', 150, 71, N'Ярославль-GSM (С)', 'ru'),
(5501, N'4442', 391, 183, N'Ярославль-GSM (С)', 'ru'),
(5502, N'4443', 599, 282, N'Ярославль-GSM (С)', 'ru'),
(5503, N'4444', 1200, 564, N'Ярославль-GSM (С)', 'ru'),
(5504, N'4445', 2200, 1034, N'Ярославль-GSM (С)', 'ru'),
(5505, N'4446', 3400, 1598, N'Ярославль-GSM (С)', 'ru'),
(5506, N'4447', 4130, 1941, N'Ярославль-GSM (С)', 'ru'),
(5507, N'4448', 6899, 3243, N'Ярославль-GSM (С)', 'ru'),
(5508, N'4449', 10600, 4982, N'Ярославль-GSM (С)', 'ru'),
(5509, N'7494', 170, 80, N'Ярославль-GSM (С)', 'ru'),
(5510, N'7495', 11999, 5640, N'Ярославль-GSM (С)', 'ru'),
(5511, N'7496', 17000, 7990, N'Ярославль-GSM (С)', 'ru'),
(5512, N'7497', 24999, 11750, N'Ярославль-GSM (С)', 'ru'),
(5513, N'7498', 35000, 16450, N'Ярославль-GSM (С)', 'ru'),
(5514, N'4440', 170, 96, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5515, N'4442', 391, 219, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5516, N'4443', 530, 299, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5517, N'4444', 1100, 621, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5518, N'4445', 2200, 1241, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5519, N'4446', 3422, 1930, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5520, N'4447', 4130, 2329, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5521, N'4448', 7100, 4005, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5522, N'4449', 10600, 5978, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5523, N'7494', 170, 96, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5524, N'7495', 11999, 6768, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5525, N'7496', 17000, 9588, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5526, N'7497', 24999, 14100, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5527, N'7498', 35000, 19740, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5528, N'4440', 199, 93, N'Utel', 'ru'),
(5529, N'4442', 250, 118, N'Utel', 'ru'),
(5530, N'4443', 550, 258, N'Utel', 'ru'),
(5531, N'4444', 1100, 517, N'Utel', 'ru'),
(5532, N'4445', 2500, 1175, N'Utel', 'ru'),
(5533, N'4446', 4501, 2116, N'Utel', 'ru'),
(5534, N'4447', 3600, 1692, N'Utel', 'ru'),
(5535, N'4448', 8850, 4160, N'Utel', 'ru'),
(5536, N'4449', 12399, 5828, N'Utel', 'ru'),
(5537, N'7494', 199, 93, N'Utel', 'ru'),
(5538, N'7495', 12399, 5828, N'Utel', 'ru'),
(5539, N'7496', 14500, 6814, N'Utel', 'ru'),
(5540, N'7497', 18000, 8459, N'Utel', 'ru'),
(5541, N'7498', 30700, 14429, N'Utel', 'ru'),
(5542, N'7733', 25830, 12140, N'МТС', 'ru'),
(5543, N'7733', 25424, 11949, N'Билайн', 'ru'),
(5544, N'7733', 30000, 17738, N'Мегафон Столичный ф-л', 'ru'),
(5545, N'7733', 28700, 13489, N'TELE2 Россия', 'ru'),
(5546, N'7733', 26017, 12228, N'Utel', 'ru'),
(5547, N'7733', 28700, 13489, N'АКОС', 'ru'),
(5548, N'7733', 28700, 16187, N'БайкалВестКом', 'ru'),
(5549, N'7733', 30000, 15510, N'Дельта-Телеком', 'ru'),
(5550, N'7733', 30000, 14100, N'Енисейтелеком', 'ru'),
(5551, N'7733', 25830, 12140, N'Кодотел', 'ru'),
(5552, N'7733', 30000, 17738, N'Мегафон Дальневосточный ф-л', 'ru'),
(5553, N'7733', 30000, 16892, N'Мегафон Кавказский ф-л', 'ru'),
(5554, N'7733', 30000, 17738, N'Мегафон Поволжский ф-л', 'ru'),
(5555, N'7733', 30000, 17738, N'Мегафон СЗ филиал', 'ru'),
(5556, N'7733', 30000, 17738, N'Мегафон Сибирский ф-л', 'ru'),
(5557, N'7733', 30000, 16892, N'Мегафон Уральский ф-л', 'ru'),
(5558, N'7733', 30000, 16892, N'Мегафон Центральный ф-л', 'ru'),
(5559, N'7733', 28700, 13489, N'Мотив', 'ru'),
(5560, N'7733', 25424, 11949, N'НСС', 'ru'),
(5561, N'7733', 25424, 9559, N'НТК', 'ru'),
(5562, N'7733', 25424, 16729, N'ОСМП', 'ru'),
(5563, N'7733', 30000, 15482, N'Остелеком', 'ru'),
(5564, N'7733', 28700, 13489, N'Пенза-GSM (Т)', 'ru'),
(5565, N'7733', 30000, 15510, N'Скайлинк', 'ru'),
(5566, N'7733', 28600, 12098, N'Смартс', 'ru'),
(5567, N'7733', 25424, 14339, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5568, N'7733', 28700, 13489, N'Ярославль-GSM (С)', 'ru'),
(5569, N'4161', 15785, 7419, N'МТС', 'ru'),
(5570, N'4161', 14407, 6771, N'Билайн', 'ru'),
(5571, N'4161', 15678, 9256, N'Мегафон Столичный ф-л', 'ru'),
(5572, N'4161', 15000, 7050, N'TELE2 Россия', 'ru'),
(5573, N'4161', 15254, 7169, N'Utel', 'ru'),
(5574, N'4161', 15000, 7050, N'АКОС', 'ru'),
(5575, N'4161', 16949, 7966, N'Астрахань GSM', 'ru'),
(5576, N'4161', 14250, 8037, N'БайкалВестКом', 'ru'),
(5577, N'4161', 15000, 7050, N'Волгоград GSM (С)', 'ru'),
(5578, N'4161', 15000, 7755, N'Дельта-Телеком', 'ru'),
(5579, N'4161', 15000, 7050, N'Енисейтелеком', 'ru'),
(5580, N'4161', 14407, 6771, N'Кодотел', 'ru'),
(5581, N'4161', 15678, 9256, N'Мегафон Дальневосточный ф-л', 'ru'),
(5582, N'4161', 15678, 8814, N'Мегафон Кавказский ф-л', 'ru'),
(5583, N'4161', 15678, 9256, N'Мегафон Поволжский ф-л', 'ru'),
(5584, N'4161', 15678, 9256, N'Мегафон СЗ филиал', 'ru'),
(5585, N'4161', 15678, 9256, N'Мегафон Сибирский ф-л', 'ru'),
(5586, N'4161', 15678, 8814, N'Мегафон Уральский ф-л', 'ru'),
(5587, N'4161', 15678, 8814, N'Мегафон Центральный ф-л', 'ru'),
(5588, N'4161', 14350, 6745, N'Мотив', 'ru'),
(5589, N'4161', 16949, 7966, N'НСС', 'ru'),
(5590, N'4161', 14407, 5417, N'НТК', 'ru'),
(5591, N'4161', 12712, 8364, N'ОСМП', 'ru'),
(5592, N'4161', 15678, 8077, N'Остелеком', 'ru'),
(5593, N'4161', 14407, 6771, N'Пенза-GSM (Т)', 'ru'),
(5594, N'4161', 15000, 7755, N'Скайлинк', 'ru'),
(5595, N'4161', 16949, 7169, N'Смартс', 'ru'),
(5596, N'4161', 16949, 7966, N'Смартс-Иваново GSM', 'ru'),
(5597, N'4161', 14350, 8093, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5598, N'4161', 16949, 7966, N'Шупашкар-GSM (Т)', 'ru'),
(5599, N'4161', 14407, 6771, N'Ярославль-GSM (С)', 'ru'),
(5600, N'4169', 2841, 1335, N'МТС', 'ru'),
(5601, N'4169', 2966, 1394, N'Билайн', 'ru'),
(5602, N'4169', 2900, 1689, N'Мегафон Столичный ф-л', 'ru'),
(5603, N'4169', 2966, 1394, N'TELE2 Россия', 'ru'),
(5604, N'4169', 2966, 1394, N'Utel', 'ru'),
(5605, N'4169', 2730, 1283, N'АКОС', 'ru'),
(5606, N'4169', 2966, 1673, N'Астрахань GSM', 'ru'),
(5607, N'4169', 2900, 1636, N'БайкалВестКом', 'ru'),
(5608, N'4169', 2900, 1363, N'Волгоград GSM (С)', 'ru'),
(5609, N'4169', 11440, 5914, N'Дельта-Телеком', 'ru'),
(5610, N'4169', 2970, 1396, N'Енисейтелеком', 'ru'),
(5611, N'4169', 11440, 5377, N'Кодотел', 'ru'),
(5612, N'4169', 2900, 1689, N'Мегафон Дальневосточный ф-л', 'ru'),
(5613, N'4169', 2900, 1607, N'Мегафон Кавказский ф-л', 'ru'),
(5614, N'4169', 2900, 1689, N'Мегафон Поволжский ф-л', 'ru'),
(5615, N'4169', 2900, 1689, N'Мегафон СЗ филиал', 'ru'),
(5616, N'4169', 2900, 1689, N'Мегафон Сибирский ф-л', 'ru'),
(5617, N'4169', 2900, 1607, N'Мегафон Уральский ф-л', 'ru'),
(5618, N'4169', 2900, 1607, N'Мегафон Центральный ф-л', 'ru'),
(5619, N'4169', 2903, 1365, N'Мотив', 'ru'),
(5620, N'4169', 2966, 1394, N'НСС', 'ru'),
(5621, N'4169', 2966, 1115, N'НТК', 'ru'),
(5622, N'4169', 2900, 1471, N'Остелеком', 'ru'),
(5623, N'4169', 2900, 1363, N'Пенза-GSM (Т)', 'ru'),
(5624, N'4169', 11440, 5914, N'Скайлинк', 'ru'),
(5625, N'4169', 2966, 1255, N'Смартс', 'ru'),
(5626, N'4169', 2900, 1636, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5627, N'4169', 2900, 1363, N'Шупашкар-GSM (Т)', 'ru'),
(5628, N'4169', 2881, 1354, N'Ярославль-GSM (С)', 'ru'),
(5658, N'4107', 11682, 5491, N'АКОС', 'ru'),
(5659, N'4107', 11100, 6261, N'Билайн', 'ru'),
(5660, N'4107', 11614, 5458, N'НСС', 'ru'),
(5661, N'4107', 14042, 7886, N'Мегафон Кавказский ф-л', 'ru'),
(5662, N'4107', 14042, 8282, N'Мегафон Сибирский ф-л', 'ru'),
(5663, N'4107', 14042, 8282, N'Мегафон Дальневосточный ф-л', 'ru'),
(5664, N'4107', 14042, 7886, N'Мегафон Центральный ф-л', 'ru'),
(5665, N'4107', 14042, 8282, N'Мегафон Поволжский ф-л', 'ru'),
(5666, N'4107', 14042, 7886, N'Мегафон Уральский ф-л', 'ru'),
(5667, N'4107', 14042, 8282, N'Мегафон Столичный ф-л', 'ru'),
(5668, N'4107', 14042, 8282, N'Мегафон СЗ филиал', 'ru'),
(5669, N'4107', 14042, 7226, N'Остелеком', 'ru'),
(5670, N'4107', 11682, 5490, N'Мотив', 'ru'),
(5671, N'4107', 11176, 5253, N'МТС', 'ru'),
(5672, N'4107', 11100, 4174, N'НТК', 'ru'),
(5673, N'4107', 11682, 6589, N'БайкалВестКом', 'ru'),
(5674, N'4107', 9900, 4653, N'Енисейтелеком', 'ru'),
(5675, N'4107', 11682, 6040, N'Скайлинк', 'ru'),
(5676, N'4107', 11682, 6040, N'Дельта-Телеком', 'ru'),
(5677, N'4107', 11700, 5500, N'Астрахань GSM', 'ru'),
(5678, N'4107', 11700, 5499, N'Смартс-Иваново GSM', 'ru'),
(5679, N'4107', 33866, 15917, N'Пенза-GSM (Т)', 'ru'),
(5680, N'4107', 11700, 4949, N'Смартс', 'ru'),
(5681, N'4107', 11700, 5499, N'Шупашкар-GSM (Т)', 'ru'),
(5682, N'4107', 11682, 5490, N'Ярославль-GSM (С)', 'ru'),
(5683, N'4107', 11682, 5492, N'TELE2 Россия', 'ru'),
(5684, N'4107', 10700, 5029, N'Utel', 'ru'),
(5685, N'4107', 11682, 6588, N'ЦентрТелеком ОАО Тамбовский ф-л', 'ru'),
(5686, N'4107', 11100, 5217, N'Кодотел', 'ru');


