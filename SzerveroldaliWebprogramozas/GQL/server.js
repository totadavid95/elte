// npm install --save sequelize sqlite3
// npm install --save-dev nodemon sequelize-cli
// npx nodemon server.js

const { ApolloServer, gql } = require('apollo-server')
// Ez az index.js-t hívja be a modelsből, ami végignézi a saját mappáját a modellek után
const models = require('./models')
const { Task, Submission } = models

const schema = gql`
type Query{
    info: InfoResult!
    generateLottery: LotteryResult!
    tasks: [Task!]!
    submissions(type: SubmissionType): [Submission!]!
    task(id: Int): Task
    submission(id: Int): Submission
}

type InfoResult{
    name: String!
    neptun: String!
    email: String!
}

type LotteryResult{
    number1: Int!
    number2: Int!
    number3: Int!
    number4: Int!
    number5: Int!
}

type Task{
    id: Int!
    title: String!
    description: String
    difficulty: Int
    mem_limit: Int
    time_limit: Float
    public: Boolean!
    submissions: [Submission!]!
}

type Submission{
    id: Int!
    type: SubmissionType!
    task: Task
    code: String!
    in_data: String!
    out_data: String
}

type Mutation{
    evaluateRepl(repl: UserCodeInput): Submission!
    evaluateTask(taskId: Int,   solution: UserCodeInput): Submission!
}

input UserCodeInput{
    code: String!
    in_data: String!
}

enum SubmissionType{
    REPL
    TASK
}
schema{
    query: Query,
    mutation: Mutation
}
`

const info = { name: 'nev', neptun: 'neptun', email: 'email' }

// Összekeveri egy tömb elemeit
shuffle = (arr) => arr.sort(() => Math.random() - 0.5)

// Előállítja a számok listáját 1-n-ig
numbers = (n) => [...Array(n).keys()].map(i => i+1)

// Ad 5 egyedi számot
numberArray = () => shuffle(numbers(90)).slice(0,5).reduce((acc, curr, ind) => { 
    acc[`number${ind+1}`] = curr 
    return acc
}, {})

const resolvers = {
    Query: {
        info: () => info,
        generateLottery: () => numberArray(),
        tasks: () => Task.findAll(),
        task: (parent, {id}) => Task.findByPk(id),
        submissions: (parent, {type}) => Submission.findAll({where: { type: type }}),
        submission: (parent, {id}) => Submission.findByPk(id),
    },
    Task: {
        submissions: (task) => task.getSubmissions(),
    },
    Submission: {
        task: (submission) => submission.getTask(),
    },
    Mutation: {
        evaluateRepl: async(parent, {repl}) => {
            //console.log(repl)
            const submission = await Submission.create({ type: 'REPL', out_data: '', ...repl })
            return submission
        },
        evaluateTask: async(parent, {taskId, solution}) => {
            const task = await Task.findByPk(taskId)
            const submission = await Submission.create({ type: 'TASK', out_data: '', ...solution })
            await submission.setTask(task)
            return submission
        }
    },
}

createDatabase = async() => {
    // A force kitörli a táblában jelenleg levő adatokat, így minden indulásnál az alábbi adatok lesznek az adatbázisban
    await models.sequelize.sync({ force: true })

    const task1 = await Task.create({ title: 'titel1', description: 'description1', difficulty: 1, mem_limit: 1, time_limit: 1.1, public: true });
    const task2 = await Task.create({ title: 'titel2', description: 'description2', difficulty: 2, mem_limit: 2, time_limit: 2.2, public: true });
    const submission1 = await Submission.create({ type: 'TASK', code: 'code1', in_data: 'in_data1',out_data: 'out_data1' });
    const submission2 = await Submission.create({ type: 'REPL', code: 'cod2', in_data: 'in_data2', out_data: 'out_dat2' });
     
    // Hozzárendelés
    task1.setSubmissions([submission1]);
    task2.setSubmissions([submission2]);
}

createDatabase()

// Szerver beállítása és elindítása, ez a 4000-es porton fog futni
const server = new ApolloServer({
    typeDefs: schema,
    resolvers,
})

server.listen()

