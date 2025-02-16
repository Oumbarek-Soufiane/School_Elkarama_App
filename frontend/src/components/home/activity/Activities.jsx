import Slider from "react-slick";
import { Container, Row } from "react-bootstrap";
import ActivityCard from "./ActivityCard";
import classes from "./Activities.module.css";
import H from "./../../../assets/img/teams/team1.jpg";

const Activities = () => {
  const settings = {
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  };

  const activities = [
    {
      id: 1,
      title: "Activity 1",
      description: "Description for Activity 1",
      image: H,
    },
    {
      id: 2,
      title: "Activity 2",
      description: "Description for Activity 2",
      image: H,
    },
    {
      id: 3,
      title: "Activity 3",
      description: "Description for Activity 3",
      image: H,
    },
    {
      id: 4,
      title: "Activity 4",
      description: "Description for Activity 4",
      image: H,
    },
    {
      id: 5,
      title: "Activity 5",
      description: "Description for Activity 5",
      image: H,
    },
  ];

  return (
    <Container fluid>
      <Container className={`p-2 p-lg-3 my-4 `}>
        <Row>
          <h1 className={`${classes.activities_title} text-center p-2`}>
            Activities
          </h1>
        </Row>
        <Row>
          <Slider {...settings}>
            {activities.map((activity) => (
              <div key={activity.id}>
                <ActivityCard
                  imgSrc={activity.image}
                  title={activity.title}
                  description={activity.description}
                />
              </div>
            ))}
          </Slider>
        </Row>
      </Container>
    </Container>
  );
};

export default Activities;
