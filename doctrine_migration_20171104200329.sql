-- Doctrine Migration File Generated on 2017-11-04 20:03:29

-- Version 20171104192245
ALTER TABLE transferfahrten CHANGE created_at created_at DATE DEFAULT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104192245');
