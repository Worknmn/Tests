select t1.* from prodtest t1
where (select count(*) from prodtest t2 where t1.Id_collection=t2.Id_collection and t2.Date > t1.Date) < 2;