import React, { useState, useEffect } from "react";
import { Button } from "react-bootstrap";
import { FaArrowUp } from "react-icons/fa";
import classes from "./ScrollToTop.module.css";

function ScrollToTop() {
  const [showButton, setShowButton] = useState(false);
  useEffect(() => {
    const handleScroll = () => {
      if (window.scrollY > 300) {
        setShowButton(true);
      } else {
        setShowButton(false);
      }
    };
    window.addEventListener("scroll", handleScroll);
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);
  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  };
  return (
    <Button
      className={`${classes.scroll_to_top} ${showButton ? classes.show : ""}`}
      onClick={scrollToTop}
    >
      <FaArrowUp />
    </Button>
  );
}

export default ScrollToTop;
