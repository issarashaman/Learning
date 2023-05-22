const express = require("express");
// const bodyParser = require("body-parser"); /* deprecated */
const cors = require("cors");

const app = express();

var corsOptions = {
  origin: "http://localhost:8081"
};

app.use(cors(corsOptions));

// parse requests of content-type - application/json
app.use(express.json()); /* bodyParser.json() is deprecated */

// parse requests of content-type - application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true })); /* bodyParser.urlencoded() is deprecated */

const db = require("./app/models");
const TutorialController = require("./app/controllers/tutorial.controller");
const TagController = require("./app/controllers/tag.controller");

const run = async () => {
  const tut1 = await TutorialController.create({
    title: "Tut#1",
    description: "Tut#1 Description",
  });
  /*
  >> Created Tutorial: {
      "id": 1,
      "title": "Tut#1",
      "description": "Tut#1 Description",
      "updatedAt": "2020-04-24T03:27:52.798Z",
      "createdAt": "2020-04-24T03:27:52.798Z"
  }
  */
  const tut2 = await TutorialController.create({
    title: "Tut#2",
    description: "Tut#2 Description",
  });
  const tut3 = await TutorialController.create({
    title: "Tut#3",
    description: "Tut#3 Description",
  });
  const tut4 = await TutorialController.create({
    title: "Tut#4",
    description: "Tut#4 Description",
  });

  const tag1 = await TagController.create({
    name: "Tag#1",
  });
  /*
  >> Created Tag: {
    "id": 1,
    "name": "Tag#1",
    "updatedAt": "2020-04-24T03:27:53.923Z",
    "createdAt": "2020-04-24T03:27:53.923Z"
  }
  */
  const tag2 = await TagController.create({
    name: "Tag#2",
  });
  await TagController.addTutorial(tag1.id, tut1.id);
  // >> added Tutorial id=1 to Tag id=1
  await TagController.addTutorial(tag1.id, tut2.id);
  // >> added Tutorial id=2 to Tag id=1
  await TagController.addTutorial(tag1.id, tut3.id);
  // >> added Tutorial id=3 to Tag id=1
  await TagController.addTutorial(tag2.id, tut3.id);
  // >> added Tutorial id=3 to Tag id=2
  await TagController.addTutorial(tag2.id, tut4.id);
  // >> added Tutorial id=4 to Tag id=2
  await TagController.addTutorial(tag2.id, tut1.id);
  // >> added Tutorial id=1 to Tag id=2

  const _tag1 = await TagController.findById(tag1.id);
  console.log(">> tag1", JSON.stringify(_tag1, null, 2));
  /*
  >> tag1 {
    "id": 1,
    "name": "Tag#1",
    "createdAt": "2020-04-24T03:27:53.000Z",
    "updatedAt": "2020-04-24T03:27:53.000Z",
    "tutorials": [
      {
        "id": 1,
        "title": "Tut#1",
        "description": "Tut#1 Description"
      },
      {
        "id": 2,
        "title": "Tut#2",
        "description": "Tut#2 Description"
      },
      {
        "id": 3,
        "title": "Tut#3",
        "description": "Tut#3 Description"
      }
    ]
  }
  */

  const tags = await TagController.findAll();
  console.log(">> tags", JSON.stringify(tags, null, 2));
  /*
  >> tags [
    {
      "id": 1,
      "name": "Tag#1",
      "createdAt": "2020-04-24T03:27:53.000Z",
      "updatedAt": "2020-04-24T03:27:53.000Z",
      "tutorials": [
        {
          "id": 1,
          "title": "Tut#1",
          "description": "Tut#1 Description"
        },
        {
          "id": 2,
          "title": "Tut#2",
          "description": "Tut#2 Description"
        },
        {
          "id": 3,
          "title": "Tut#3",
          "description": "Tut#3 Description"
        }
      ]
    },
    {
      "id": 2,
      "name": "Tag#2",
      "createdAt": "2020-04-24T03:27:53.000Z",
      "updatedAt": "2020-04-24T03:27:53.000Z",
      "tutorials": [
        {
          "id": 1,
          "title": "Tut#1",
          "description": "Tut#1 Description"
        },
        {
          "id": 3,
          "title": "Tut#3",
          "description": "Tut#3 Description"
        },
        {
          "id": 4,
          "title": "Tut#4",
          "description": "Tut#4 Description"
        }
      ]
    }
  ]
  */

  const tuts = await TutorialController.findAll();
  console.log(">> tuts", JSON.stringify(tuts, null, 2));
  /*
  >> tuts [
    {
      "id": 1,
      "title": "Tut#1",
      "description": "Tut#1 Description",
      "createdAt": "2020-04-24T03:27:52.000Z",
      "updatedAt": "2020-04-24T03:27:52.000Z",
      "tags": [
        {
          "id": 1,
          "name": "Tag#1"
        },
        {
          "id": 2,
          "name": "Tag#2"
        }
      ]
    },
    {
      "id": 2,
      "title": "Tut#2",
      "description": "Tut#2 Description",
      "createdAt": "2020-04-24T03:27:53.000Z",
      "updatedAt": "2020-04-24T03:27:53.000Z",
      "tags": [
        {
          "id": 1,
          "name": "Tag#1"
        }
      ]
    },
    {
      "id": 3,
      "title": "Tut#3",
      "description": "Tut#3 Description",
      "createdAt": "2020-04-24T03:27:53.000Z",
      "updatedAt": "2020-04-24T03:27:53.000Z",
      "tags": [
        {
          "id": 1,
          "name": "Tag#1"
        },
        {
          "id": 2,
          "name": "Tag#2"
        }
      ]
    },
    {
      "id": 4,
      "title": "Tut#4",
      "description": "Tut#4 Description",
      "createdAt": "2020-04-24T03:27:53.000Z",
      "updatedAt": "2020-04-24T03:27:53.000Z",
      "tags": [
        {
          "id": 2,
          "name": "Tag#2"
        }
      ]
    }
  ]
  */
};

// db.sequelize.sync();
db.sequelize.sync({ force: true }).then(() => {
  console.log("Drop and re-sync db.");
  run();
});

// simple route
app.get("/", (req, res) => {
  res.json({ message: "Welcome to bezkoder application." });
});

require("./app/routes/tutorial.routes.js")(app);

// set port, listen for requests
const PORT = process.env.PORT || 8080;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}.`);
});
