# Transaction to add a relation and account at once, where both are connected bij RelationNumber
START TRANSACTION;
	INSERT INTO relation (RelationType) VALUES ('Fairsoft');
	INSERT INTO account (Username, `Password`, RELATIONRelationNumber) VALUES
			('SightVision', 'sOftw@r1gIneer', (
				SELECT RelationNumber
				FROM relation
				ORDER BY RelationNumber DESC
				LIMIT 1
				)
			);
	
	INSERT INTO relation (RelationType) VALUES ('Fairsoft');
	INSERT INTO account (Username, `Password`, RELATIONRelationNumber) VALUES
			('tdebeijer', 'kweenie', (
				SELECT RelationNumber
				FROM relation
				ORDER BY RelationNumber DESC
				LIMIT 1
				)
			);
			
	INSERT INTO relation (RelationType) VALUES ('Fairsoft');
	INSERT INTO account (Username, `Password`, RELATIONRelationNumber) VALUES
			('jremijnse', 'wachtwoord', (
				SELECT RelationNumber
				FROM relation
				ORDER BY RelationNumber DESC
				LIMIT 1
				)
			);
			
	INSERT INTO relation (RelationType) VALUES ('Fairsoft');
	INSERT INTO account (Username, `Password`, RELATIONRelationNumber) VALUES
			('pkandzia', 'dagweken', (
				SELECT RelationNumber
				FROM relation
				ORDER BY RelationNumber DESC
				LIMIT 1
				)
			);
COMMIT;			
	