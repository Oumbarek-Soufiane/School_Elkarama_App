import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";

export async function sectionLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [sectionResponse, levelsResponse] = await Promise.all([
      axios.get(AppURL.manageSection(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allLevels(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const sectionData = sectionResponse.data;
    const levelsData = levelsResponse.data;
    
    return { section: sectionData.section, levels: levelsData.levels };
  } catch (error) {
    console.error("Error fetching section or levels data:", error);
    throw error;
  }
}

export async function sectionsLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allSections(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching school years data:", error);
    throw error;
  }
}
