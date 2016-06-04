
CREATE VIEW vw_yotei AS
SELECT tb_schedule.*, tb_calendar.cname,tb_calendar.cdetail,tb_calendar.scope,tb_calendar.owner
FROM tb_schedule NATURAL JOIN tb_calendar;

