-- Doctrine Migration File Generated on 2017-11-04 20:02:20

-- Version 20171031201841
ALTER TABLE transferfahrten CHANGE created_at created_at DATETIME DEFAULT NULL;
INSERT INTO migration_versions (version) VALUES ('20171031201841');
