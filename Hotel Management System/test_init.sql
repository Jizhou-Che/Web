INSERT INTO user VALUES
('Yiming', '123qwe', 'Yiming Li', 'Pass01', '18888681722', 'scyyl3@nottingham.edu.cn'),
('Zihao', 'qweasd', 'Zihao Zeng', 'Pass02', '18888681111', 'scyzz3@nottingham.edu.cn');

INSERT INTO staff VALUES
('Jizhou', 'scyjc1', 'Jizhou Che', 'scyjc1', '18888681747', 'scyjc1@nottingham.edu.cn', DEFAULT);

INSERT INTO booking VALUES
('Yiming', 'Pass01', 102, '2019-05-01', '2019-05-15'), -- Completed.
('Yiming', 'Pass03', 713, '2019-05-01', '2019-09-01'), -- Checked in.
('Yiming', 'Pass01', 1004, '2019-09-01', '2019-09-02'); -- Booked.
