const fs = require('fs');
const { promisify } = require('util');

const pReadDir = promisify(fs.readdir);
const pReadFile = promisify(fs.readFile);
const pWriteFile = promisify(fs.writeFile);

async function task() {
    const filenames = await pReadDir('./inputs');
    const promises = filenames.map(filename => pReadFile('./inputs/' + filename, 'utf-8'));
    const datas = await Promise.all(promises);
    const outData = datas.join('\n');
    await pWriteFile('./output-async.txt', outData);
    console.log('Program vege')
}

task()

/*
pReadDir('./inputs')
    .then(filenames => {
        const promises = filenames.map(filename => pReadFile('./inputs/' + filename, 'utf-8'))
        //console.log(promises)
        return Promise.all(promises)
    })
    .then(datas => datas.join('\n'))
    .then(outData => pWriteFile('./output-promise.txt', outData))
    .then(() => console.log('Program vege'))
    .catch(err => console.log(err))
*/