import cv2
import numpy as np
import sys

def hex_to_rgb(value):
    value = value.lstrip('#')
    lv = len(value)
    return tuple(int(value[i:i + lv // 3], 16) for i in range(0, lv, lv // 3))


def color_filter(img_name, colorhex, intensity):
    rgb = hex_to_rgb(colorhex)
    color = np.uint8([[[rgb[2],rgb[1],rgb[0] ]]])
    hsv_color = cv2.cvtColor(color,cv2.COLOR_BGR2HSV)
    hsv_col = hsv_color[0][0]

    img = cv2.imread("images_to_process/"+img_name)


    intensity = float(intensity)
    lower = np.array([max(0,hsv_col[0]-intensity),40,40], dtype=np.int32)
    upper = np.array([min(179,hsv_col[0]+intensity),255,255], dtype=np.int32)

    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    mask = cv2.inRange(hsv, lower, upper)
    mask_inv = cv2.bitwise_not(mask)

    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Extract the dimensions of the original image
    rows, cols, channels = img.shape
    img = img[0:rows, 0:cols]

    # Bitwise-OR mask and original image
    colored_portion = cv2.bitwise_or(img, img, mask = mask)
    colored_portion = colored_portion[0:rows, 0:cols]
    

    # Bitwise-OR inverse mask and grayscale image
    gray_portion = cv2.bitwise_or(gray, gray, mask = mask_inv)
    gray_portion = np.stack((gray_portion,)*3, axis=-1)

    # Combine the two images
    output = colored_portion + gray_portion

    cv2.imwrite("images_processed/filtered_"+img_name, output)

print(sys.argv) 
color_filter(sys.argv[1],sys.argv[2],sys.argv[3])

