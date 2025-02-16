import React, { useRef } from "react";
import Hero from "../components/home/hero/Hero";
import Programs from "../components/home/programs/Programs";
import ScrollToTop from "../components/home/scroll/ScrollToTop";
import Teams from "../components/home/team/Teams";
import Gallery from "./../components/home/gallery/Gallery";
import Activities from "../components/home/activity/Activities";
import Contact from "../components/home/contact/Contact";
import Footer from "./../components/home/footer/Footer";

function HomePage() {
  const programRef = useRef(null);

  return (
    <div>
      <Hero programRef={programRef} />
      <Programs ref={programRef} />
      <Teams />
      <Gallery />
      <ScrollToTop />
      <Activities />
      <Contact />
      <Footer />
    </div>
  );
}

export default HomePage;
