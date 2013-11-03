create table [dbo].[ErrorLog] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [msg] [nvarchar](240) NULL, 
                [url] [nvarchar](720) NULL, 
                [is_warning] [tinyint] DEFAULT 0,
                [timestamp] [datetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_ErrorLog] PRIMARY KEY CLUSTERED
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
                [password] [nvarchar](255) NOT NULL,
                [timezone] [tinyint] DEFAULT 0,
                [timestamp] [datetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_Clients] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );

INSERT INTO [dbo].[Clients] 
(email, tech_key, balance, password, timezone) 
VALUES ('aydar@creativestripe.ru','1234',10,'$2a$04$wM.DTWJ4ejRsn9bW.4buxuvwrMTj2GMFML3BF9CFv.6XCBbKkrdx2',4);
			
create table [dbo].[SMS]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [datetime] DEFAULT GETUTCDATE(),
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
                CONSTRAINT [PK_SMS] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [dbo].[SMS] 
(response_text, response_is_sent, response_is_dynamic, sender_phone, sender_country, sender_cost, sender_service_number, sender_text, client_share, client_ID, service_ID, provider_ID
, external_ID, external_operator, external_operator_ID, external_share) 
VALUES ('response_text', 0, 1, '79510665133', 'ru', 10, '4443', 'sender_text', 5, 1, 1, 1
, 1, 'rostelecom', 1, 9);
INSERT INTO [dbo].[SMS] 
(response_text, response_is_sent, response_is_dynamic, sender_phone, sender_country, sender_cost, sender_service_number, sender_text, client_share, client_ID, service_ID, provider_ID
, external_ID, external_operator, external_operator_ID, external_share) 
VALUES ('response_text', 1, 1, '79510665133', 'ru', 10, '4443', 'sender_text', 5, 1, 1, 1
, 34484459280, 'rostelecom', 1, 9);

create table [dbo].[SMSServices] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [country] [char](2) NULL, 
				[prefix] [nvarchar](255) NULL,
				[response_static] [nvarchar](500) NULL,
                [is_dynamic] [tinyint] DEFAULT 0,
				[dynamic_responder_URL] [nvarchar](500) NULL,
				[share] [int] DEFAULT 95,
                [status] [tinyint] DEFAULT 1, --0-deleted 1-active 2-disabled(visible)
				[client_ID] [int] DEFAULT NULL, 
				[provider_ID] [int] DEFAULT NULL,
                [is_pseudo] [tinyint] DEFAULT 0,
                [timestamp] [datetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_SMSServices] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', 'kmbord566', 'response_static', 1, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0);
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', 'kmbords', 'response_static', 0, 'http://flybill.ru/test.php', 55, 1, 1, 1, 1);
INSERT INTO [dbo].[SMSServices] 
(country, prefix, response_static, is_dynamic, dynamic_responder_URL, share, status, client_ID, provider_ID,is_pseudo) 
VALUES ('ru', 'kmbordd', 'response_static', 1, 'http://flybill.ru/test.php', 55, 1, 1, 1, 0);

create table [dbo].[SessionSMS]
            (
                [ID] [bigint] IDENTITY(1,1) NOT NULL,
				[timestamp] [datetime] DEFAULT GETUTCDATE(),
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
VALUES ('response_text', '79510665133', 'ru', '4443', 0.3, 1, 1);

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
                [timestamp] [datetime] DEFAULT GETUTCDATE(),
                CONSTRAINT [PK_SessionServices] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [dbo].[SessionServices] 
(country, is_text_unlocked, status, default_text, client_ID, provider_ID, client_service_ID) 
VALUES ('ru', 1, 1, 'smstext', 1, 1, 2);

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
VALUES ('kmbord', 'ru', 1);

create table [dbo].[SMSProviders] 
            (
                [ID] [int] IDENTITY(1,1) NOT NULL,
                [name] [nvarchar](500) NULL,
                [is_async] [tinyint] DEFAULT 0,
                [timestamp] [datetime] DEFAULT GETUTCDATE(),
				[status] [tinyint] DEFAULT 1, --0-hidden 1-active
                CONSTRAINT [PK_SMSProviders] PRIMARY KEY CLUSTERED
                    (
                        [ID] ASC
                    )
            );
			
INSERT INTO [dbo].[SMSProviders] 
(name, is_async, status) 
VALUES ('pl3', 1, 1);
	