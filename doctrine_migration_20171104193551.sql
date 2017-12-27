-- Doctrine Migration File Generated on 2017-11-04 19:35:51

-- Version 20171031202734
ALTER TABLE transferfahrten CHANGE fahrzeuge_id fahrzeuge_id INT NOT NULL;
INSERT INTO migration_versions (version) VALUES ('20171031202734');

-- Version 20171104192245
ALTER TABLE transferfahrten CHANGE created_at created_at DATE DEFAULT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104192245');

-- Version 20171104192503
ALTER TABLE transferfahrten CHANGE fahrzeuge_id fahrzeuge_id INT NOT NULL, CHANGE created_at created_at DATE DEFAULT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104192503');

-- Version 20171104192554
ALTER TABLE transferfahrten CHANGE fahrzeuge_id fahrzeuge_id INT NOT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104192554');

-- Version 20171104193046
ALTER TABLE transferfahrten CHANGE fahrzeuge_id fahrzeuge_id INT NOT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104193046');

-- Version 20171104193336
ALTER TABLE transferfahrten CHANGE created_at created_at DATE DEFAULT NULL;
INSERT INTO migration_versions (version) VALUES ('20171104193336');
