import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

sns.set(style="whitegrid")


def generate_market_data():
    rng = pd.date_range(start="2024-01-01", periods=90, freq="D")
    trend = np.linspace(1000, 1500, len(rng))
    seasonality = 100 * np.sin(np.linspace(0, 3 * np.pi, len(rng)))
    noise = np.random.normal(scale=50, size=len(rng))
    revenue = trend + seasonality + noise
    return pd.DataFrame({"date": rng, "revenue": revenue})


def moving_average_forecast(df, window=7):
    df["forecast"] = df["revenue"].rolling(window=window).mean()
    return df


def plot_forecast(df):
    plt.figure(figsize=(12, 6))
    plt.plot(df["date"], df["revenue"], label="Actual")
    plt.plot(df["date"], df["forecast"], label="Forecast", linestyle="--")
    plt.title("Dự báo doanh thu thị trường")
    plt.xlabel("Ngày")
    plt.ylabel("Doanh thu")
    plt.legend()
    plt.tight_layout()
    plt.savefig("market_forecast.png")
    plt.close()
    print("Đã lưu biểu đồ vào market_forecast.png")


def main():
    df = generate_market_data()
    df = moving_average_forecast(df)
    print(df[["date", "revenue", "forecast"]].head(10))
    plot_forecast(df)


if __name__ == "__main__":
    main()
