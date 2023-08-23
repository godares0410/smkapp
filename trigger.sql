-- CREATE TRIGGER `insert_jurusan_trigger` AFTER INSERT ON `siswa`
--  FOR EACH ROW BEGIN
--     INSERT INTO jurusan (kode_jurusan)
--     SELECT DISTINCT NEW.jurusan
--     FROM siswa
--     WHERE NEW.jurusan NOT IN (SELECT kode_jurusan FROM jurusan);
-- END

-- CREATE TRIGGER `insert_kelas_trigger` AFTER INSERT ON `siswa`
--  FOR EACH ROW BEGIN
--     INSERT INTO kelas (nama_kelas)
--     SELECT DISTINCT NEW.kelas
--     FROM siswa
--     WHERE NEW.kelas NOT IN (SELECT nama_kelas FROM kelas);
-- END

-- CREATE TRIGGER `insert_rombel_trigger` AFTER INSERT ON `siswa`
--  FOR EACH ROW BEGIN
--     INSERT INTO rombel (nama_rombel)
--     SELECT DISTINCT NEW.rombel
--     FROM siswa
--     WHERE NEW.rombel NOT IN (SELECT nama_rombel FROM rombel);
-- END
DELIMITER //
CREATE TRIGGER insert_kelas_trigger AFTER INSERT ON siswa
FOR EACH ROW
BEGIN
    INSERT INTO kelas (nama_kelas, created_at, updated_at)
    SELECT DISTINCT NEW.kelas, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()
    FROM siswa
    WHERE NEW.kelas NOT IN (SELECT nama_kelas FROM kelas);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER insert_jurusan_trigger AFTER INSERT ON siswa
FOR EACH ROW
BEGIN
    INSERT INTO jurusan (kode_jurusan, created_at, updated_at)
    SELECT DISTINCT NEW.jurusan, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()
    FROM siswa
    WHERE NEW.jurusan NOT IN (SELECT kode_jurusan FROM jurusan);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER insert_rombel_trigger AFTER INSERT ON siswa
FOR EACH ROW
BEGIN
    INSERT INTO rombel (nama_rombel, created_at, updated_at)
    SELECT DISTINCT NEW.rombel, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()
    FROM siswa
    WHERE NEW.rombel NOT IN (SELECT nama_rombel FROM rombel);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER insert_jabatan_trigger AFTER INSERT ON guru
FOR EACH ROW
BEGIN
    INSERT INTO jabatan (nama_jabatan, created_at, updated_at)
    SELECT DISTINCT NEW.jabatan, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP()
    FROM guru
    WHERE NEW.jabatan NOT IN (SELECT nama_jabatan FROM jabatan);
END //
DELIMITER ;