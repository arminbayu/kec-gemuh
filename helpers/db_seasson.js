const { json } = require('body-parser');
var postgreSql = require('../database');

const readSession = async () => {
    try {
        const res = await postgreSql.query("SELECT * FROM wa_sessions ORDER BY created_at DESC LIMIT 1;");
        if(res.rows.length > 0){
            if(res.rows[0].session == '[]'){
                return JSON.parse(res.rows[0].session);
            }else{
                return JSON.parse(JSON.stringify(res.rows[0].session));
            }
        }else{
            return '';
        }
    } catch (error) {
        throw error;
    }
}

const saveSession = (session) => {
    postgreSql.query(
        `INSERT INTO "wa_sessions" ("session")  
           VALUES ($1)`, [JSON.stringify(session)], (err, res) => {
        if (err) {
            console.log('Error Session Created: ' + err);
        } else {
            console.log('Insert Session Created: ' + "success");
        }
    });
}

module.exports = {
    readSession,
    saveSession
}