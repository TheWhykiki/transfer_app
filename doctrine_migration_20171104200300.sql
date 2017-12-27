-- Doctrine Migration File Generated on 2017-11-04 20:03:00

-- Version 20171031202734
ALTER TABLE transferfahrten CHANGE fahrzeuge_id fahrzeuge_id INT NOT NULL;
INSERT INTO migration_versions (version) VALUES ('20171031202734');
