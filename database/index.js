const { Client } = require('pg');

const client = new Client({
  connectionString: 'postgres://kbemrihpjsqbiz:8b44ba7ce263e744f5113a70f0ec0ed97844a9e4460c99cda2952820cd413058@ec2-35-170-146-54.compute-1.amazonaws.com:5432/d14f2mdluiomkq',
  ssl: {
    rejectUnauthorized: false
  }
});
// const client = new Client({
//   connectionString: process.env.DATABASE_URL,
//   ssl: {
//     rejectUnauthorized: false
//   }
// });

module.exports = client;
