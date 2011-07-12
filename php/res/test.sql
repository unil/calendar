/*
SELECT event_id, event_owner, event_title, event_title, event_description, event_begin, event_end, events.recurrences_id, recurrence_mode, recurrence_start, recurrence_end recurrence_exception_date
FROM events, recurrences, recurrence_exceptions
WHERE event_begin >= '2010-2-28' AND event_end <= '2010-2-28' AND events.rooms_id=13 AND recurrence_id = events.recurrences_id AND recurrence_id = recurrence_exceptions.recurrences_id
ORDER BY event_begin;
*/


SELECT
    E.event_id,
    E.owner, E.title, 
    E.description,
    DATE_FORMAT(D.begin, '%Y-%m-%d') AS E_Dbegin,
    DATE_FORMAT(D.begin, '%H:%i') AS E_Hbegin,
    DATE_FORMAT(D.end, '%Y-%m-%d') AS E_Dend,
    DATE_FORMAT(D.end, '%H:%i') AS E_Hend,
    D.event_date_id,
    E.mode,
    (SELECT DATE_FORMAT(MAX(D.end), '%Y-%m-%d') as lastDate
        FROM event_dates D
        WHERE E.event_id = D.event_id) AS lastDate
FROM
    events E
    LEFT OUTER JOIN
        event_dates D ON E.event_id = D.event_id
WHERE
    D.begin >= '2011-04-01' AND D.end <= '2011-04-30 23:59' AND E.room_id=13
ORDER BY D.begin