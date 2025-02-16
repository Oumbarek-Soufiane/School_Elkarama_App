import React, { useState, useRef } from "react";
import ImageGallery from "react-image-gallery";
import { FaTimes } from "react-icons/fa";
import { RiVerifiedBadgeFill } from "react-icons/ri";
import logo from "./../../../assets/img/alkarama-logo.png";
import { FaInstagram } from "react-icons/fa";
import classes from "./Gallery.module.css";
import { Col, Container, Row } from "react-bootstrap";
import Button from "../../UI/buttons/Button";
import { Link } from "react-router-dom";

const photos = [
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 1",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 2",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 3",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 4",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 5",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 6",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 7",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 1",
    description: "Image description",
  },
  {
    original:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    thumbnail:
      "https://images.pexels.com/photos/1462630/pexels-photo-1462630.jpeg",
    title: "Image Title 1",
    description: "Image description",
  },
];

const Gallery = () => {
  const [selectedIndex, setSelectedIndex] = useState(-1);
  const imageGalleryRef = useRef(null);

  const handleImageClick = (index) => {
    setSelectedIndex(index);
  };

  const handleCloseGallery = () => {
    setSelectedIndex(-1);
  };

  const handleExitFullScreen = () => {
    if (imageGalleryRef.current) {
      imageGalleryRef.current.exitFullScreen();
      setSelectedIndex(-1);
    }
  };

  const remainingImages = photos.length - 5;

  return (
    <Container
      fluid
      className="p-5"
      style={{ backgroundColor: "var(--alkarama-primary-color)" }}
    >
      <Row>
        <h1 className={`${classes.gallery_title} text-center p-2`}>
          Galerie
        </h1>
      </Row>
      <div className="d-flex align-items-center justify-content-center text-center p-3">
        <div className="m-2 d-flex align-items-center">
          <img
            src={logo}
            alt="Avatar"
            style={{ width: "50px", height: "50px", borderRadius: "50%" }}
            className="me-2"
          />
          <p className="text-white fw-bolder mb-0">
            @alkarama.boussaid1{" "}
            <RiVerifiedBadgeFill className={`${classes.verified_icon}`} />
          </p>
          <div
            className="text-white mx-2"
            style={{ height: "50px", borderLeft: "2px solid white" }}
          ></div>
        </div>
        <div className="m-2">
          <Link
            to="https://www.instagram.com/alkarama.boussaid1/"
            target="_blank"
            rel="noopener noreferrer"
          >
            <Button
              className={`${classes.button} px-4 fw-bolder`}
              text="Suivre"
              backgroundColor="var(--alkarama-white)"
              textColor="var(--alkarama-primary-color)"
              icon={<FaInstagram />}
            />
          </Link>
        </div>
      </div>
      <Container>
        <Row>
          <Col
            lg={6}
            md={12}
            sm={12}
            className={`${classes.img_container} mb-4 position-relative overflow-hidden rounded`}
            onClick={() => handleImageClick(0)}
          >
            <img
              src={photos[0].thumbnail}
              alt={photos[0].title}
              className="img-fluid"
            />
            <div className={`${classes.image_title}`}>{photos[0].title}</div>
          </Col>
          <Col>
            <Row>
              {photos.slice(1, 5).map((photo, index) => (
                <Col
                  lg={6}
                  md={12}
                  sm={12}
                  key={index + 1}
                  className={`${classes.img_container} col-6 mb-4 position-relative overflow-hidden rounded`}
                  onClick={() => handleImageClick(index + 1)}
                >
                  <div className={`${classes.square_image} rounded`}>
                    <img
                      src={photo.thumbnail}
                      alt={photo.title}
                      className="img-fluid"
                    />
                    <div className={`${classes.image_title}`}>
                      {photo.title}
                    </div>
                    {index === 3 && remainingImages > 0 && (
                      <div className={`${classes.overlay}`}>
                        <span>+{remainingImages}</span>
                      </div>
                    )}
                  </div>
                </Col>
              ))}
            </Row>
          </Col>
        </Row>

        {selectedIndex !== -1 && (
          <div
            className={`${classes.fullscreen_overlay}`}
            onClick={handleCloseGallery}
          ></div>
        )}
        {selectedIndex !== -1 && (
          <div className={`${classes.fullscreen_overlay} p-2`}>
            <ImageGallery
              ref={imageGalleryRef}
              items={photos}
              startIndex={selectedIndex}
              showFullscreenButton={true}
              showPlayButton={true}
              showThumbnails={true}
              onClose={handleCloseGallery}
            />
          </div>
        )}
        {selectedIndex !== -1 && (
          <div
            className={`${classes.exit_icon_container}`}
            onClick={handleExitFullScreen}
          >
            <FaTimes className={`${classes.exit_icon}`} />
          </div>
        )}
      </Container>
    </Container>
  );
};

export default Gallery;
